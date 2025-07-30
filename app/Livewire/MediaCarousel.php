<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class MediaCarousel extends Component
{
    public $mediaItems = [];
    public $maxItems = 10;
    public $photoGalleryRoute = '/galerie-foto';
    public $videoGalleryRoute = '/galerie-video';

    public function mount()
    {
        $this->loadMediaItems();
    }

    private function loadMediaItems()
    {
        try {
            // Get files from the public storage
            $files = collect();
            
            // Look for media files in common directories
            $mediaPaths = [
                'gallery/photos',
                'gallery/videos', 
                'media/photos',
                'media/videos',
                'uploads',
                'public'
            ];

            foreach ($mediaPaths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    $pathFiles = Storage::disk('public')->files($path);
                    foreach ($pathFiles as $file) {
                        $files->push($file);
                    }
                }
            }

            // Filter and process media files
            $this->mediaItems = $files
                ->filter(function ($file) {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    return in_array($extension, [
                        'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', // Images
                        'mp4', 'webm', 'ogg', 'avi', 'mov', 'wmv'   // Videos
                    ]);
                })
                ->take($this->maxItems)
                ->map(function ($file) {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'avi', 'mov', 'wmv']);
                    
                    return [
                        'url' => Storage::disk('public')->url($file),
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'title' => $this->generateTitle(pathinfo($file, PATHINFO_FILENAME)),
                        'description' => $isVideo ? 'Vezi mai multe videoclipuri în galeria noastră' : 'Explorează galeria foto completă',
                        'type' => $isVideo ? 'video' : 'image',
                        'path' => $file
                    ];
                })
                ->values()
                ->toArray();

            // If no media found, add some demo content
            if (empty($this->mediaItems)) {
                $this->mediaItems = $this->getDemoContent();
            }

        } catch (\Exception $e) {
            // Fallback to demo content if there's an error
            $this->mediaItems = $this->getDemoContent();
        }
    }

    private function generateTitle($filename)
    {
        // Convert filename to a readable title
        return ucwords(str_replace(['-', '_'], ' ', $filename));
    }

    private function getDemoContent()
    {
        return [
            [
                'url' => '/wave/img/Logo_black.png',
                'name' => 'CCB Activități',
                'title' => 'Activități Recreative',
                'description' => 'Descoperiți galeria noastră foto cu momente speciale din activitățile copiilor',
                'type' => 'image'
            ],
            [
                'url' => '/wave/img/Logo_black.png',
                'name' => 'CCB Evenimente',
                'title' => 'Evenimente Speciale',
                'description' => 'Vezi fotografiile din evenimentele și competițiile organizate',
                'type' => 'image'
            ],
            [
                'url' => '/wave/img/Logo_black.png', // This will be treated as video thumbnail
                'name' => 'CCB Video',
                'title' => 'Videoclipuri Activități',
                'description' => 'Urmăriți videoclipurile noastre cu activități și momente speciale',
                'type' => 'video'
            ]
        ];
    }

    public function refreshMedia()
    {
        $this->loadMediaItems();
    }

    public function render()
    {
        return view('livewire.media-carousel');
    }
}
