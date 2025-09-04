<?php

namespace App\Livewire\Media;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

/**
 * SimpleMediaCarousel Livewire Component
 * 
 * A simplified version of the media carousel that doesn't rely on
 * the Media model until the database is set up properly.
 * This ensures the frontend continues working while setting up the backend.
 * 
 * @package App\Livewire\Media
 * @author Wave Framework
 * @version 1.0.0
 */
class SimpleMediaCarousel extends Component
{
    /**
     * Array of media items to display in the carousel
     * 
     * @var array
     */
    public $items = [];

    /**
     * Maximum number of media items to display
     * 
     * @var int
     */
    public $maxItems = 10;

    /**
     * Supported image file extensions
     * 
     * @var array
     */
    protected $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp', 'tiff'];

    /**
     * Supported video file extensions
     * 
     * @var array
     */
    protected $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv', 'mkv'];

    /**
     * Storage directories to scan for media files
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
     * 
     * @return void
     */
    public function mount()
    {
        $this->loadMediaItems();
    }

    /**
     * Load media items (simplified version)
     * 
     * @return void
     */
    protected function loadMediaItems()
    {
        try {
            // Scan storage directories for files
            $storageFiles = $this->scanMediaDirectories();
            
            if (!empty($storageFiles)) {
                $this->items = $this->processMediaFiles($storageFiles);
            } else {
                // Generate demo content
                $this->items = $this->generateDemoContent();
            }
        } catch (\Exception $e) {
            // Fall back to demo content on any error
            $this->items = $this->generateDemoContent();
        }
    }

    /**
     * Scan media directories for files
     * 
     * @return array
     */
    protected function scanMediaDirectories()
    {
        $allFiles = [];
        
        foreach ($this->mediaPaths as $path) {
            try {
                if (Storage::disk('public')->exists($path)) {
                    $files = Storage::disk('public')->files($path);
                    
                    $mediaFiles = array_filter($files, function ($file) {
                        return $this->isMediaFile($file);
                    });
                    
                    $allFiles = array_merge($allFiles, $mediaFiles);
                }
            } catch (\Exception $e) {
                // Continue with other directories
            }
        }
        
        return $allFiles;
    }

    /**
     * Check if file is supported media type
     * 
     * @param string $filePath
     * @return bool
     */
    protected function isMediaFile($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return in_array($extension, array_merge($this->imageExtensions, $this->videoExtensions));
    }

    /**
     * Process media files with random selection of 10 photos and 10 videos
     * 
     * @param array $files
     * @return array
     */
    protected function processMediaFiles($files)
    {
        $images = [];
        $videos = [];
        
        // Separate images and videos
        foreach ($files as $file) {
            try {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                
                $url = Storage::disk('public')->url($file);
                $type = in_array($extension, $this->imageExtensions) ? 'image' : 'video';
                
                $item = [
                    'url' => $url,
                    'name' => $fileName,
                    'title' => $this->generateTitle($fileName, $type),
                    'description' => $this->generateDescription($type),
                    'type' => $type,
                ];
                
                if ($type === 'image') {
                    $images[] = $item;
                } else {
                    $videos[] = $item;
                }
                
            } catch (\Exception $e) {
                // Skip problematic files
            }
        }
        
        // Randomly select up to 10 images and 10 videos
        shuffle($images);
        shuffle($videos);
        
        $selectedImages = array_slice($images, 0, 10);
        $selectedVideos = array_slice($videos, 0, 10);
        
        // Merge and shuffle for random display order
        $items = array_merge($selectedImages, $selectedVideos);
        shuffle($items);
        
        return $items;
    }

    /**
     * Generate title from filename
     * 
     * @param string $fileName
     * @param string $type
     * @return string
     */
    protected function generateTitle($fileName, $type)
    {
        $title = str_replace(['_', '-'], ' ', $fileName);
        $title = ucwords($title);
        
        if (strlen($title) < 5 || is_numeric($title)) {
            $prefix = $type === 'image' ? 'Fotografie' : 'Video';
            $title = $prefix . ' ' . $title;
        }
        
        return $title;
    }

    /**
     * Generate description
     * 
     * @param string $type
     * @return string
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
     * Generate demo content
     * 
     * @return array
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
    }

    /**
     * Get item counts by type
     * 
     * @param string $type
     * @return int
     */
    public function getItemCountByType($type)
    {
        return count(array_filter($this->items, function ($item) use ($type) {
            return $item['type'] === $type;
        }));
    }

    /**
     * Render the component
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.media.carousel.simple-media-carousel', [
            'items' => $this->items,
        ]);
    }
}
