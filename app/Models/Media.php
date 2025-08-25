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
        'video_category',
        'video_source',
        'youtube_url',
        'youtube_id',
        'duration',
        'resolution',
        'thumbnail_url',
        'embed_params',
        'is_featured',
        'is_featured_video',
        'is_visible',
        'sort_order',
        'alt_text',
        'tags',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_featured_video' => 'boolean',
        'is_visible' => 'boolean',
        'file_size' => 'integer',
        'sort_order' => 'integer',
        'duration' => 'integer',
        'tags' => 'array',
        'metadata' => 'array',
        'embed_params' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];

    /**
     * Available media types
     */
    const MEDIA_TYPES = [
        'image' => 'Imagine',
        'video' => 'Video',
    ];

    /**
     * Available video categories
     */
    const VIDEO_CATEGORIES = [
        'competitii' => 'Competiții',
        'antrenamente' => 'Antrenamente',
        'demonstratii' => 'Demonstrații',
        'evenimente' => 'Evenimente Speciale',
        'educativ' => 'Educational',
        'prezentari' => 'Prezentări Rasa',
        'interviuri' => 'Interviuri',
        'diverse' => 'Diverse',
    ];

    /**
     * Available video sources
     */
    const VIDEO_SOURCES = [
        'local' => 'Fișier Local',
        'youtube' => 'YouTube',
    ];

    /**
     * Available categories - simplified (kept for backwards compatibility)
     * Now mainly used for legacy data, new uploads don't require category selection
     */
    const CATEGORIES = [
        'gallery' => 'Gallery (Legacy)',
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
     * Get random images for carousel - latest uploaded, random order
     *
     * @param int $limit Number of images to retrieve
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCarouselImages($limit = 10)
    {
        // Get latest uploaded images in random order
        return static::visible()
            ->byType('image')
            ->orderBy('created_at', 'desc')
            ->limit($limit * 2) // Get more to randomize from
            ->get()
            ->shuffle()
            ->take($limit);
    }

    /**
     * Get random videos for carousel - latest uploaded, random order
     *
     * @param int $limit Number of videos to retrieve
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCarouselVideos($limit = 10)
    {
        // Get latest uploaded videos in random order
        return static::visible()
            ->byType('video')
            ->orderBy('created_at', 'desc')
            ->limit($limit * 2) // Get more to randomize from
            ->get()
            ->shuffle()
            ->take($limit);
    }

    /**
     * Get all gallery images (for "Vezi galeria foto" page) - all visible images
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGalleryImages()
    {
        return static::visible()
            ->byType('image')
            ->ordered()
            ->get();
    }

    /**
     * Get all gallery videos (for "Vezi galeria video" page) - all visible videos
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGalleryVideos()
    {
        return static::visible()
            ->byType('video')
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
     * Get videos by category
     *
     * @param string|null $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getVideosByCategory(?string $category = null)
    {
        $query = static::visible()
            ->byType('video')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        if ($category) {
            $query->where('video_category', $category);
        }

        return $query;
    }

    /**
     * Get videos grouped by category
     *
     * @return array
     */
    public static function getVideosGroupedByCategory(): array
    {
        $videos = static::visible()
            ->byType('video')
            ->orderBy('video_category')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return $videos->groupBy('video_category')->toArray();
    }

    /**
     * Get video duration in human readable format
     *
     * @return string|null
     */
    public function getFormattedDuration(): ?string
    {
        if (!$this->duration) {
            return null;
        }

        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Check if video is from YouTube
     *
     * @return bool
     */
    public function isYouTubeVideo(): bool
    {
        return $this->isVideo() && $this->video_source === 'youtube';
    }

    /**
     * Check if video is local file
     *
     * @return bool
     */
    public function isLocalVideo(): bool
    {
        return $this->isVideo() && $this->video_source === 'local';
    }

    /**
     * Get video embed URL (for YouTube or local)
     *
     * @return string|null
     */
    public function getVideoEmbedUrl(): ?string
    {
        if ($this->isYouTubeVideo() && $this->youtube_id) {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        }

        if ($this->isLocalVideo() && $this->file_path) {
            return Storage::url($this->file_path);
        }

        return null;
    }

    /**
     * Get video thumbnail URL
     *
     * @return string|null
     */
    public function getVideoThumbnail(): ?string
    {
        if ($this->isYouTubeVideo() && $this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }

        // For local videos, you might want to generate thumbnails
        // For now, return a default video thumbnail
        return '/wave/img/video-placeholder.svg';
    }

    /**
     * Auto-extract YouTube ID from URL
     *
     * @param string $url
     * @return string|null
     */
    public static function extractYouTubeId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
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
            
            // Set default category for backwards compatibility
            if (!$media->category) {
                $media->category = 'gallery';
            }
            
            // Auto-extract YouTube ID when YouTube URL is provided
            if ($media->youtube_url && !$media->youtube_id) {
                $media->youtube_id = static::extractYouTubeId($media->youtube_url);
                $media->video_source = 'youtube';
                $media->media_type = 'video';
                
                // For YouTube videos, set default values for required fields
                if (!$media->file_name) {
                    $media->file_name = 'youtube_' . $media->youtube_id;
                }
                if (!$media->mime_type) {
                    $media->mime_type = 'video/youtube';
                }
            }
            
            // Set video_source default for local videos
            if ($media->media_type === 'video' && !$media->video_source) {
                $media->video_source = $media->youtube_url ? 'youtube' : 'local';
            }
        });

        // Auto-update YouTube ID when updating
        static::updating(function ($media) {
            if ($media->isDirty('youtube_url') && $media->youtube_url) {
                $media->youtube_id = static::extractYouTubeId($media->youtube_url);
                $media->video_source = 'youtube';
                $media->media_type = 'video';
                
                // Update other fields for YouTube videos
                if (!$media->file_name) {
                    $media->file_name = 'youtube_' . $media->youtube_id;
                }
                if (!$media->mime_type) {
                    $media->mime_type = 'video/youtube';
                }
            } elseif ($media->isDirty('youtube_url') && !$media->youtube_url) {
                // Clear YouTube data when URL is removed
                $media->youtube_id = null;
                $media->video_source = 'local';
            }
        });

        // Validate that we have either file_path or youtube_url
        static::saving(function ($media) {
            if (!$media->file_path && !$media->youtube_url) {
                throw new \InvalidArgumentException('Either file_path or youtube_url must be provided');
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
