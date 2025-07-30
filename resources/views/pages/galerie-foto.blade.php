<?php

use function Laravel\Folio\{name};
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;

name('galerie-foto');

new class extends Component
{
    public $photos = [];
    public $selectedPhoto = null;
    public $showModal = false;

    public function mount()
    {
        $this->loadPhotos();
    }

    private function loadPhotos()
    {
        try {
            $files = collect();
            
            // Look for photo files in common directories
            $photoPaths = [
                'gallery/photos',
                'media/photos',
                'uploads',
                'public'
            ];

            foreach ($photoPaths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    $pathFiles = Storage::disk('public')->files($path);
                    foreach ($pathFiles as $file) {
                        $files->push($file);
                    }
                }
            }

            // Filter for image files only
            $this->photos = $files
                ->filter(function ($file) {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                })
                ->map(function ($file) {
                    return [
                        'url' => Storage::disk('public')->url($file),
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'title' => ucwords(str_replace(['-', '_'], ' ', pathinfo($file, PATHINFO_FILENAME))),
                        'path' => $file
                    ];
                })
                ->values()
                ->toArray();

            // If no photos found, add demo content
            if (empty($this->photos)) {
                $this->photos = [
                    [
                        'url' => '/wave/img/Logo_black.png',
                        'name' => 'CCB Demo 1',
                        'title' => 'Clubul Copiilor Botoșani',
                        'path' => 'demo1.png'
                    ],
                    [
                        'url' => '/wave/img/Logo_black.png',
                        'name' => 'CCB Demo 2',
                        'title' => 'Activități Copii',
                        'path' => 'demo2.png'
                    ],
                    [
                        'url' => '/wave/img/Logo_black.png',
                        'name' => 'CCB Demo 3',
                        'title' => 'Evenimente Speciale',
                        'path' => 'demo3.png'
                    ]
                ];
            }

        } catch (\Exception $e) {
            $this->photos = [];
        }
    }

    public function openPhoto($index)
    {
        $this->selectedPhoto = $this->photos[$index] ?? null;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedPhoto = null;
    }

    public function nextPhoto()
    {
        if ($this->selectedPhoto) {
            $currentIndex = array_search($this->selectedPhoto, $this->photos);
            $nextIndex = ($currentIndex + 1) % count($this->photos);
            $this->selectedPhoto = $this->photos[$nextIndex];
        }
    }

    public function prevPhoto()
    {
        if ($this->selectedPhoto) {
            $currentIndex = array_search($this->selectedPhoto, $this->photos);
            $prevIndex = $currentIndex === 0 ? count($this->photos) - 1 : $currentIndex - 1;
            $this->selectedPhoto = $this->photos[$prevIndex];
        }
    }
}; ?>

<x-app-layout>
    @volt('galerie-foto')
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Galerie Foto</h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Descoperiți momentele speciale capturate în fotografiile noastre din activitățile Clubului Copiilor Botoșani
                    </p>
                </div>

                <!-- Photo Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($photos as $index => $photo)
                        <div 
                            wire:click="openPhoto({{ $index }})"
                            class="group relative aspect-square overflow-hidden rounded-lg bg-gray-100 cursor-pointer transform transition-transform hover:scale-105"
                        >
                            <img 
                                src="{{ $photo['url'] }}" 
                                alt="{{ $photo['title'] }}"
                                class="w-full h-full object-cover group-hover:opacity-75 transition-opacity"
                                loading="lazy"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-white font-semibold text-sm">{{ $photo['title'] }}</h3>
                                </div>
                            </div>
                            <!-- Zoom Icon -->
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(empty($photos))
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Nu sunt disponibile fotografii momentan.</p>
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

        <!-- Photo Modal -->
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
                    class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"
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
                    class="inline-block w-full max-w-5xl mx-auto my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg"
                >
                    @if($selectedPhoto)
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
                            @if(count($photos) > 1)
                                <button 
                                    wire:click="prevPhoto"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-3 transition-colors"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>

                                <button 
                                    wire:click="nextPhoto"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-3 transition-colors"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif

                            <!-- Image -->
                            <img 
                                src="{{ $selectedPhoto['url'] ?? '' }}" 
                                alt="{{ $selectedPhoto['title'] ?? '' }}"
                                class="w-full h-auto max-h-[80vh] object-contain"
                            />

                            <!-- Image info -->
                            <div class="p-6 bg-white">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $selectedPhoto['title'] ?? '' }}</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endvolt
</x-app-layout>
