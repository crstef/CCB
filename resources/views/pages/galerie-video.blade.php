<?php

use function Laravel\Folio\{name};
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;

name('galerie-video');

new class extends Component
{
    public $videos = [];
    public $selectedVideo = null;
    public $showModal = false;

    public function mount()
    {
        $this->loadVideos();
    }

    private function loadVideos()
    {
        try {
            $files = collect();
            
            // Look for video files in common directories
            $videoPaths = [
                'gallery/videos',
                'media/videos',
                'uploads',
                'public'
            ];

            foreach ($videoPaths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    $pathFiles = Storage::disk('public')->files($path);
                    foreach ($pathFiles as $file) {
                        $files->push($file);
                    }
                }
            }

            // Filter for video files only
            $this->videos = $files
                ->filter(function ($file) {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    return in_array($extension, ['mp4', 'webm', 'ogg', 'avi', 'mov', 'wmv']);
                })
                ->map(function ($file) {
                    return [
                        'url' => Storage::disk('public')->url($file),
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'title' => ucwords(str_replace(['-', '_'], ' ', pathinfo($file, PATHINFO_FILENAME))),
                        'path' => $file,
                        'thumbnail' => $this->generateThumbnail($file)
                    ];
                })
                ->values()
                ->toArray();

            // If no videos found, add demo content
            if (empty($this->videos)) {
                $this->videos = [
                    [
                        'url' => '/demo-video.mp4', // You'll need to add actual video files
                        'name' => 'CCB Video Demo 1',
                        'title' => 'Activități Recreative',
                        'path' => 'demo1.mp4',
                        'thumbnail' => '/wave/img/Logo_black.png'
                    ],
                    [
                        'url' => '/demo-video2.mp4',
                        'name' => 'CCB Video Demo 2',
                        'title' => 'Evenimente Speciale',
                        'path' => 'demo2.mp4',
                        'thumbnail' => '/wave/img/Logo_black.png'
                    ]
                ];
            }

        } catch (\Exception $e) {
            $this->videos = [];
        }
    }

    private function generateThumbnail($videoPath)
    {
        // For now, return a placeholder or the logo
        // In a real implementation, you might generate video thumbnails
        return '/wave/img/Logo_black.png';
    }

    public function openVideo($index)
    {
        $this->selectedVideo = $this->videos[$index] ?? null;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedVideo = null;
    }

    public function nextVideo()
    {
        if ($this->selectedVideo) {
            $currentIndex = array_search($this->selectedVideo, $this->videos);
            $nextIndex = ($currentIndex + 1) % count($this->videos);
            $this->selectedVideo = $this->videos[$nextIndex];
        }
    }

    public function prevVideo()
    {
        if ($this->selectedVideo) {
            $currentIndex = array_search($this->selectedVideo, $this->videos);
            $prevIndex = $currentIndex === 0 ? count($this->videos) - 1 : $currentIndex - 1;
            $this->selectedVideo = $this->videos[$prevIndex];
        }
    }
}; ?>

<x-app-layout>
    @volt('galerie-video')
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Galerie Video</h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Urmăriți videoclipurile din activitățile și evenimentele Clubului Copiilor Botoșani
                    </p>
                </div>

                <!-- Video Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($videos as $index => $video)
                        <div 
                            wire:click="openVideo({{ $index }})"
                            class="group relative aspect-video overflow-hidden rounded-lg bg-gray-100 cursor-pointer transform transition-transform hover:scale-105"
                        >
                            <!-- Thumbnail -->
                            <img 
                                src="{{ $video['thumbnail'] }}" 
                                alt="{{ $video['title'] }}"
                                class="w-full h-full object-cover group-hover:opacity-75 transition-opacity"
                                loading="lazy"
                            />
                            
                            <!-- Play button overlay -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-black/50 backdrop-blur-sm rounded-full p-4 group-hover:bg-black/70 group-hover:scale-110 transition-all duration-200">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Gradient overlay with title -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-white font-semibold text-sm">{{ $video['title'] }}</h3>
                                </div>
                            </div>

                            <!-- Video icon -->
                            <div class="absolute top-4 left-4">
                                <div class="bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold">
                                    VIDEO
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(empty($videos))
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Nu sunt disponibile videoclipuri momentan.</p>
                    </div>
                @endif

                <!-- Back to Home Button -->
                <div class="text-center mt-12">
                    <a href="/" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Înapoi la pagina principală
                    </a>
                </div>
            </div>
        </div>

        <!-- Video Modal -->
        <div 
            x-data="{ show: @entangle('showModal') }"
            x-show="show"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div 
                    x-show="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="$wire.closeModal()"
                    class="fixed inset-0 bg-black bg-opacity-90 transition-opacity"
                ></div>

                <!-- Modal content -->
                <div 
                    x-show="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-6xl mx-auto my-8 overflow-hidden text-left align-middle transition-all transform bg-black shadow-xl rounded-lg"
                >
                    @if($selectedVideo)
                        <div class="relative">
                            <!-- Close button -->
                            <button 
                                wire:click="closeModal"
                                class="absolute top-4 right-4 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-colors"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>

                            <!-- Navigation buttons -->
                            @if(count($videos) > 1)
                                <button 
                                    wire:click="prevVideo"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-3 transition-colors"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>

                                <button 
                                    wire:click="nextVideo"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-3 transition-colors"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif

                            <!-- Video Player -->
                            <video 
                                src="{{ $selectedVideo['url'] ?? '' }}" 
                                controls
                                autoplay
                                class="w-full h-auto max-h-[80vh] object-contain"
                            >
                                Browser-ul dvs. nu suportă redarea video.
                            </video>

                            <!-- Video info -->
                            <div class="p-6 bg-white">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $selectedVideo['title'] ?? '' }}</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endvolt
</x-app-layout>
