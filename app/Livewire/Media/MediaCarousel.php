<?php

namespace App\Livewire\Media;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Media;

/**
 * MediaCarousel Livewire Component
 * 
 * This component handles the backend logic for the media carousel display.
 * It uses the Media model to load managed media files and provides 
 * fallback demo content when no media files are found.
 * 
 * Features:
 * - Database-driven media management
 * - Automatic file type detection (images/videos)
 * - Storage directory scanning (fallback)
 * - Demo content generation for development
 * - File metadata extraction
 * - URL generation for public access
 * 
 * @package App\Livewire\Media
 * @author Wave Framework
 * @version 1.0.0
 */
class MediaCarousel extends Component
{
    /**
     * Array of media items to display in the carousel
     * Each item contains: url, name, title, description, type
     * 
     * @var array
     */
    public $items = [];

    /**
     * Maximum number of media items to display
     * Prevents performance issues with large galleries
     * 
     * @var int
     */
    public $maxItems = 10;

    /**
     * Supported image file extensions
     * Used for automatic file type detection
     * 
     * @var array
     */
    protected $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];

    /**
     * Supported video file extensions
     * Used for automatic file type detection
     * 
     * @var array
     */
    protected $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv'];

    /**
     * Storage directories to scan for media files
     * Relative to the storage/app/public directory
     * 
     * @var array
     */
    protected $mediaPaths = [
        'gallery/photos',
        'gallery/videos',
        'gallery',
        'uploads'
    ];

        /**
     * Component initialization
     * Called when the component is first loaded
     * Loads media items from database first, then storage as fallback
     * 
     * @return void
     */
    public function mount()
    {
        $this->loadMediaItems();
    }

    /**
     * Main method to load media items for the carousel
     * Priority: Database managed media -> Storage files -> Demo content
     * 
     * @return void
     */
    protected function loadMediaItems()
    {
        // First, try to load from database (managed media)
        $databaseMedia = $this->loadFromDatabase();
        
        if ($databaseMedia->isNotEmpty()) {
            $this->items = $this->processDatabaseMedia($databaseMedia);
            return;
        }

        // Fallback: Scan storage directories for files
        $storageFiles = $this->scanMediaDirectories();
        
        if (!empty($storageFiles)) {
            $this->items = $this->processMediaFiles($storageFiles);
            return;
        }

        // Final fallback: Generate demo content for development
        $this->items = $this->generateDemoContent();
    }

    /**
     * Load media items from the database
     * Gets carousel-appropriate media items
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function loadFromDatabase()
    {
        try {
            // Get exactly 10 random photos and 10 random videos from Gallery
            $images = Media::getCarouselImages(10);
            $videos = Media::getCarouselVideos(10);
            
            // Merge and shuffle for random display order
            return $images->merge($videos)->shuffle();
        } catch (\Exception $e) {
            // Log error and return empty collection to fall back to storage scan
            \Log::warning('MediaCarousel: Database media loading failed', [
                'error' => $e->getMessage()
            ]);
            
            return collect();
        }
    }

    /**
     * Process database media into carousel format
     * Converts Media models to carousel item arrays
     * 
     * @param \Illuminate\Database\Eloquent\Collection $mediaItems
     * @return array
     */
    protected function processDatabaseMedia($mediaItems)
    {
        $items = [];
        
        foreach ($mediaItems as $media) {
            // Pentru videoclipuri YouTube, folosește youtube_url în loc de url
            $mediaUrl = $media->url;
            if ($media->media_type === 'video' && $media->video_source === 'youtube' && $media->youtube_url) {
                $mediaUrl = $media->youtube_url;
            }
            
            $items[] = [
                'url' => $mediaUrl,
                'name' => $media->file_name,
                'title' => $media->title,
                'description' => $media->description ?: $this->generateDescription($media->media_type),
                'type' => $media->media_type,
                'alt_text' => $media->alt_text ?: $media->title,
                'is_featured' => $media->is_featured,
                'category' => $media->category,
                'tags' => $media->tags ?: [],
            ];
        }
        
        return $items;
    }

    /**
     * Scan configured media directories for files
     * Looks for image and video files in predefined paths
     * 
     * @return array Array of file paths found in storage
     */
    protected function scanMediaDirectories()
    {
        $allFiles = [];
        
        foreach ($this->mediaPaths as $path) {
            try {
                // Check if the directory exists in storage
                if (Storage::disk('public')->exists($path)) {
                    // Get all files from the directory
                    $files = Storage::disk('public')->files($path);
                    
                    // Filter for supported media files only
                    $mediaFiles = array_filter($files, function ($file) {
                        return $this->isMediaFile($file);
                    });
                    
                    // Merge with existing files
                    $allFiles = array_merge($allFiles, $mediaFiles);
                }
            } catch (\Exception $e) {
                // Log error but continue with other directories
                \Log::warning("Could not scan media directory: {$path}", ['error' => $e->getMessage()]);
            }
        }
        
        return $allFiles;
    }

    /**
     * Check if a file is a supported media type
     * Determines file type based on extension
     * 
     * @param string $filePath Path to the file
     * @return bool True if file is supported media type
     */
    protected function isMediaFile($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        return in_array($extension, $this->imageExtensions) || 
               in_array($extension, $this->videoExtensions);
    }

    /**
     * Determine if a file is an image
     * Based on file extension
     * 
     * @param string $filePath Path to the file
     * @return bool True if file is an image
     */
    protected function isImage($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return in_array($extension, $this->imageExtensions);
    }

    /**
     * Determine if a file is a video
     * Based on file extension
     * 
     * @param string $filePath Path to the file
     * @return bool True if file is a video
     */
    protected function isVideo($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return in_array($extension, $this->videoExtensions);
    }

    /**
     * Process media files into carousel item format
     * Converts file paths to displayable items with metadata
     * 
     * @param array $files Array of file paths from storage
     * @return array Processed items ready for carousel display
     */
    protected function processMediaFiles($files)
    {
        $items = [];
        
        foreach ($files as $file) {
            try {
                // Get file information
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                
                // Generate public URL for the file
                $url = Storage::disk('public')->url($file);
                
                // Determine file type
                $type = $this->isImage($file) ? 'image' : 'video';
                
                // Create item array with all necessary data
                $items[] = [
                    'url' => $url,
                    'name' => $fileName,
                    'title' => $this->generateTitle($fileName, $type),
                    'description' => $this->generateDescription($type),
                    'type' => $type,
                    'extension' => $extension,
                    'path' => $file
                ];
                
            } catch (\Exception $e) {
                // Log error but continue with other files
                \Log::warning("Error processing media file: {$file}", ['error' => $e->getMessage()]);
            }
        }
        
        return $items;
    }

    /**
     * Generate a user-friendly title from filename
     * Converts technical filenames to readable titles
     * 
     * @param string $fileName Original filename without extension
     * @param string $type Media type (image/video)
     * @return string User-friendly title
     */
    protected function generateTitle($fileName, $type)
    {
        // Replace underscores and hyphens with spaces
        $title = str_replace(['_', '-'], ' ', $fileName);
        
        // Capitalize first letter of each word
        $title = ucwords($title);
        
        // Add type prefix if title is too generic
        if (strlen($title) < 5 || is_numeric($title)) {
            $prefix = $type === 'image' ? 'Fotografie' : 'Video';
            $title = $prefix . ' ' . $title;
        }
        
        return $title;
    }

    /**
     * Generate appropriate description based on media type
     * Provides contextual descriptions for different media types
     * 
     * @param string $type Media type (image/video)
     * @return string Contextual description
     */
    protected function generateDescription($type)
    {
        if ($type === 'image') {
            return 'Explorează galeria foto pentru mai multe imagini frumoase';
        } else {
            return 'Urmărește galeria video pentru conținut multimedia';
        }
    }

    /**
     * Generate demo content for development and testing
     * Creates placeholder items when no real media files exist
     * Uses placeholder services for realistic demo content
     * 
     * @return array Array of demo carousel items
     */
    protected function generateDemoContent()
    {
        return [
            [
                'url' => 'https://picsum.photos/800/600?random=1',
                'name' => 'demo-photo-1',
                'title' => 'Fotografie Demonstrativă 1',
                'description' => 'Aceasta este o imagine demo pentru testarea caruselului',
                'type' => 'image'
            ],
            [
                'url' => 'https://picsum.photos/800/600?random=2',
                'name' => 'demo-photo-2',
                'title' => 'Fotografie Demonstrativă 2',
                'description' => 'O altă imagine demo pentru galeria foto',
                'type' => 'image'
            ],
            [
                'url' => 'https://picsum.photos/800/600?random=3',
                'name' => 'demo-photo-3',
                'title' => 'Fotografie Demonstrativă 3',
                'description' => 'Ultima imagine demo din carusel',
                'type' => 'image'
            ]
        ];
    }

    /**
     * Refresh media items
     * Public method to reload media from storage
     * Useful for updating carousel after file uploads
     * 
     * @return void
     */
    public function refreshMedia()
    {
        $this->loadMediaItems();
    }

    /**
     * Get items filtered by type
     * Returns only images or videos based on parameter
     * 
     * @param string $type Filter type ('image' or 'video')
     * @return array Filtered items
     */
    public function getItemsByType($type)
    {
        return array_filter($this->items, function ($item) use ($type) {
            return $item['type'] === $type;
        });
    }

    /**
     * Get total count of media items
     * 
     * @return int Number of media items
     */
    public function getItemCount()
    {
        return count($this->items);
    }

    /**
     * Get count of items by type
     * 
     * @param string $type Media type to count
     * @return int Number of items of specified type
     */
    public function getItemCountByType($type)
    {
        return count($this->getItemsByType($type));
    }

    /**
     * Render the component view
     * Returns the Blade view for the carousel component
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.media.carousel.media-carousel', [
            'items' => $this->items,
            'imageCount' => $this->getItemCountByType('image'),
            'videoCount' => $this->getItemCountByType('video'),
            'totalCount' => $this->getItemCount()
        ]);
    }
}
