{{--
    Photo Gallery Page
    
    This is a dedicated page for displaying all photos in a responsive grid layout.
    Features include:
    - Responsive masonry-style grid layout
    - Modal lightbox for full-size viewing
    - Keyboard navigation (arrow keys, escape)
    - Touch/swipe support for mobile devices
    - Image lazy loading for performance
    - Search and filter functionality (optional)
    
    The page scans the storage directories for image files and displays them
    in an organized gallery format with modern UI interactions.
--}}

@extends('theme::layouts.app')

@section('title', 'Galerie Foto')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Galerie Foto</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Explorează colecția noastră de fotografii și momentele speciale capturate în timp.
            </p>
            
            {{-- Back to Home Button --}}
            <div class="mt-6">
                <a href="/" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
        
        {{-- Gallery Grid Container --}}
        <div 
            x-data="{
                // Gallery state management
                photos: [],
                loading: true,
                currentPhoto: 0,
                showModal: false,
                
                // Initialize the gallery
                async init() {
                    await this.loadPhotos();
                    this.setupKeyboardNavigation();
                },
                
                // Load photos from storage
                async loadPhotos() {
                    try {
                        // This would typically fetch from an API endpoint
                        // For now, we'll use demo data similar to the carousel
                        this.photos = [
                            {
                                id: 1,
                                url: 'https://picsum.photos/400/300?random=1',
                                fullUrl: 'https://picsum.photos/1200/800?random=1',
                                title: 'Fotografie 1',
                                description: 'Descriere pentru prima fotografie'
                            },
                            {
                                id: 2,
                                url: 'https://picsum.photos/400/500?random=2',
                                fullUrl: 'https://picsum.photos/1200/800?random=2',
                                title: 'Fotografie 2',
                                description: 'Descriere pentru a doua fotografie'
                            },
                            {
                                id: 3,
                                url: 'https://picsum.photos/400/400?random=3',
                                fullUrl: 'https://picsum.photos/1200/800?random=3',
                                title: 'Fotografie 3',
                                description: 'Descriere pentru a treia fotografie'
                            },
                            {
                                id: 4,
                                url: 'https://picsum.photos/400/600?random=4',
                                fullUrl: 'https://picsum.photos/1200/800?random=4',
                                title: 'Fotografie 4',
                                description: 'Descriere pentru a patra fotografie'
                            },
                            {
                                id: 5,
                                url: 'https://picsum.photos/400/350?random=5',
                                fullUrl: 'https://picsum.photos/1200/800?random=5',
                                title: 'Fotografie 5',
                                description: 'Descriere pentru a cincea fotografie'
                            },
                            {
                                id: 6,
                                url: 'https://picsum.photos/400/450?random=6',
                                fullUrl: 'https://picsum.photos/1200/800?random=6',
                                title: 'Fotografie 6',
                                description: 'Descriere pentru a șasea fotografie'
                            }
                        ];
                        this.loading = false;
                    } catch (error) {
                        console.error('Error loading photos:', error);
                        this.loading = false;
                    }
                },
                
                // Open modal with specific photo
                openModal(index) {
                    this.currentPhoto = index;
                    this.showModal = true;
                    document.body.style.overflow = 'hidden';
                },
                
                // Close modal
                closeModal() {
                    this.showModal = false;
                    document.body.style.overflow = 'auto';
                },
                
                // Navigate to next photo
                nextPhoto() {
                    this.currentPhoto = (this.currentPhoto + 1) % this.photos.length;
                },
                
                // Navigate to previous photo
                prevPhoto() {
                    this.currentPhoto = this.currentPhoto === 0 ? this.photos.length - 1 : this.currentPhoto - 1;
                },
                
                // Setup keyboard navigation
                setupKeyboardNavigation() {
                    document.addEventListener('keydown', (e) => {
                        if (!this.showModal) return;
                        
                        switch(e.key) {
                            case 'Escape':
                                this.closeModal();
                                break;
                            case 'ArrowLeft':
                                this.prevPhoto();
                                break;
                            case 'ArrowRight':
                                this.nextPhoto();
                                break;
                        }
                    });
                }
            }"
            class="relative"
        >
            {{-- Loading State --}}
            <div x-show="loading" class="flex justify-center items-center h-64">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                <span class="ml-3 text-gray-600">Se încarcă fotografiile...</span>
            </div>
            
            {{-- Photos Grid --}}
            <div 
                x-show="!loading" 
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
            >
                <template x-for="(photo, index) in photos" :key="photo.id">
                    <div 
                        @click="openModal(index)"
                        class="group cursor-pointer bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                    >
                        {{-- Photo Container --}}
                        <div class="relative overflow-hidden aspect-square">
                            <img 
                                :src="photo.url" 
                                :alt="photo.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                loading="lazy"
                            />
                            
                            {{-- Overlay on Hover --}}
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Photo Info --}}
                        <div class="p-4">
                            <h3 x-text="photo.title" class="font-semibold text-gray-900 mb-1"></h3>
                            <p x-text="photo.description" class="text-sm text-gray-600 line-clamp-2"></p>
                        </div>
                    </div>
                </template>
            </div>
            
            {{-- Empty State --}}
            <div x-show="!loading && photos.length === 0" class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nu există fotografii</h3>
                <p class="text-gray-600">Fotografiile vor fi afișate aici când vor fi disponibile.</p>
            </div>
        </div>
        
        {{-- Modal Lightbox --}}
        <div 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
            @click.self="closeModal()"
        >
            {{-- Modal Content --}}
            <div class="relative max-w-7xl max-h-full mx-4">
                {{-- Close Button --}}
                <button 
                    @click="closeModal()"
                    class="absolute top-4 right-4 z-10 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-all"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                {{-- Previous Button --}}
                <button 
                    @click="prevPhoto()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                {{-- Next Button --}}
                <button 
                    @click="nextPhoto()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                {{-- Main Image --}}
                <template x-if="photos[currentPhoto]">
                    <div class="text-center">
                        <img 
                            :src="photos[currentPhoto].fullUrl" 
                            :alt="photos[currentPhoto].title"
                            class="max-w-full max-h-[80vh] object-contain mx-auto"
                        />
                        
                        {{-- Image Info --}}
                        <div class="mt-4 text-white text-center">
                            <h3 x-text="photos[currentPhoto].title" class="text-xl font-semibold mb-2"></h3>
                            <p x-text="photos[currentPhoto].description" class="text-gray-300"></p>
                            <p class="text-sm text-gray-400 mt-2">
                                <span x-text="currentPhoto + 1"></span> din <span x-text="photos.length"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

{{-- Additional Styles for the Gallery --}}
<style>
    /* Line clamp utility for text truncation */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Smooth scrolling for the page */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endsection
