<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Media Model
 * 
 * Manages photos and videos in the media gallery system.
 * Handles file metadata, categorization, and gallery organization.
 * 
 * @package App\Models
 * @author Wave Framework
 * @version 1.0.0
 */
class Media extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'media_type',
        'category',
        'is_featured',
        'is_visible',
        'sort_order',
        'alt_text',
        'tags',
        'metadata',
        'youtube_url', // Added support for YouTube URLs
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'file_size' => 'integer',
        'sort_order' => 'integer',
        'tags' => 'array',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Available media types
     */
    const MEDIA_TYPES = [
        'image' => 'Image',
        'video' => 'Video',
    ];

    /**
     * Available categories - full options restored
     */
    const CATEGORIES = [
        'gallery' => 'Gallery',
        'carousel' => 'Carousel',
        'hero' => 'Hero Section',
        'events' => 'Events',
        'members' => 'Members',
        'training' => 'Training',
        'competitions' => 'Competitions',
        'other' => 'Other',
    ];

    /**
     * Get the full URL for the media file
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Get the full file path from storage root
     *
     * @return string
     */
    public function getFullPathAttribute(): string
    {
        return Storage::disk('public')->path($this->file_path);
    }

    /**
     * Check if the media is an image
     *
     * @return bool
     */
    public function isImage(): bool
    {
        return $this->media_type === 'image';
    }

    /**
     * Check if the media is a video
     *
     * @return bool
     */
    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    /**
     * Check if this is a YouTube video
     *
     * @return bool
     */
    public function isYouTube(): bool
    {
        if (!$this->isVideo()) {
            return false;
        }
        
        return !empty($this->youtube_url) || (isset($this->metadata['youtube_url']) && !empty($this->metadata['youtube_url']));
    }

    /**
     * Get YouTube video ID from URL
     *
     * @return string|null
     */
    public function getYouTubeId(): ?string
    {
        if (!$this->isYouTube()) {
            return null;
        }
        
        $url = $this->youtube_url ?? $this->metadata['youtube_url'] ?? '';
        
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        return null;
    }

    /**
     * Get YouTube thumbnail URL
     *
     * @param string $quality maxresdefault, hqdefault, mqdefault, sddefault, default
     * @return string|null
     */
    public function getYouTubeThumbnail(string $quality = 'maxresdefault'): ?string
    {
        $youtubeId = $this->getYouTubeId();
        
        if (!$youtubeId) {
            return null;
        }
        
        return "https://img.youtube.com/vi/{$youtubeId}/{$quality}.jpg";
    }

    /**
     * Get the video URL (YouTube embed or file URL)
     *
     * @return string
     */
    public function getVideoUrl(): string
    {
        if ($this->isYouTube()) {
            return $this->youtube_url ?? $this->metadata['youtube_url'] ?? '';
        }
        
        return $this->url;
    }

    /**
     * Get formatted file size
     *
     * @return string
     */
    public function getFormattedSizeAttribute(): string
    {
        if (!$this->file_size) {
            return 'Unknown';
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Scope: Get only visible media
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope: Get only featured media
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Get media by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('media_type', $type);
    }

    /**
     * Scope: Get media by category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: Order by sort order, then by creation date
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Get random images for carousel from Gallery category (with fallback)
     *
     * @param int $limit Number of images to retrieve
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCarouselImages($limit = 10)
    {
        // First try Gallery category
        $images = static::visible()
            ->byType('image')
            ->byCategory('gallery')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
            
        // If not enough from Gallery, supplement with other categories
        if ($images->count() < $limit) {
            $additional = static::visible()
                ->byType('image')
                ->whereNotIn('category', ['gallery'])
                ->whereIn('category', ['carousel', 'hero', 'events'])
                ->inRandomOrder()
                ->limit($limit - $images->count())
                ->get();
                
            $images = $images->merge($additional);
        }
        
        return $images;
    }

    /**
     * Get random videos for carousel from Gallery category (with fallback)
     *
     * @param int $limit Number of videos to retrieve
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCarouselVideos($limit = 10)
    {
        // First try Gallery category
        $videos = static::visible()
            ->byType('video')
            ->byCategory('gallery')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
            
        // If not enough from Gallery, supplement with other categories
        if ($videos->count() < $limit) {
            $additional = static::visible()
                ->byType('video')
                ->whereNotIn('category', ['gallery'])
                ->whereIn('category', ['carousel', 'hero', 'events'])
                ->inRandomOrder()
                ->limit($limit - $videos->count())
                ->get();
                
            $videos = $videos->merge($additional);
        }
        
        return $videos;
    }

    /**
     * Get all gallery images (for "Vezi galeria foto" page)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGalleryImages()
    {
        return static::visible()
            ->byType('image')
            ->byCategory('gallery')
            ->ordered()
            ->get();
    }

    /**
     * Get all gallery videos (for "Vezi galeria video" page)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGalleryVideos()
    {
        return static::visible()
            ->byType('video')
            ->byCategory('gallery')
            ->ordered()
            ->get();
    }

    /**
     * Import existing storage files into Gallery category
     *
     * @param string $directory Directory to scan (relative to storage/app/public)
     * @return array Import results
     */
    public static function importFromStorage($directory = 'gallery')
    {
        $imported = 0;
        $skipped = 0;
        $errors = [];
        
        $fullPath = 'storage/app/public/' . $directory;
        $storageFiles = [];
        
        // Scan directory recursively
        if (Storage::disk('public')->exists($directory)) {
            $storageFiles = Storage::disk('public')->allFiles($directory);
        }
        
        foreach ($storageFiles as $filePath) {
            try {
                // Check if already imported
                if (static::where('file_path', $filePath)->exists()) {
                    $skipped++;
                    continue;
                }
                
                $fileName = basename($filePath);
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $mimeType = Storage::disk('public')->mimeType($filePath);
                $fileSize = Storage::disk('public')->size($filePath);
                
                // Determine media type
                $mediaType = str_starts_with($mimeType, 'image/') ? 'image' : 'video';
                
                // Skip non-media files
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'webm', 'ogg', 'mov'])) {
                    continue;
                }
                
                // Create media record
                static::create([
                    'title' => ucwords(str_replace(['_', '-'], ' ', pathinfo($fileName, PATHINFO_FILENAME))),
                    'description' => 'Imported from storage',
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'media_type' => $mediaType,
                    'category' => 'gallery',
                    'is_visible' => true,
                    'is_featured' => false,
                    'sort_order' => 0,
                ]);
                
                $imported++;
                
            } catch (\Exception $e) {
                $errors[] = "Error importing {$filePath}: " . $e->getMessage();
            }
        }
        
        return [
            'imported' => $imported,
            'skipped' => $skipped,
            'errors' => $errors,
        ];
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-detect media type when creating
        static::creating(function ($media) {
            if (!$media->media_type && $media->mime_type) {
                $media->media_type = str_starts_with($media->mime_type, 'image/') ? 'image' : 'video';
            }
        });

        // Clean up file when deleting
        static::deleting(function ($media) {
            if ($media->file_path && Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
        });
    }
}
