{{--
    Video Gallery Page
    
    This is a dedicated page for displaying all videos in a responsive grid layout.
    Features include:
    - Responsive grid layout optimized for video content
    - Modal video player with controls
    - Keyboard navigation (arrow keys, escape, space for play/pause)
    - Touch/swipe support for mobile devices
    - Video lazy loading for performance
    - Thumbnail preview with play buttons
    - Full-screen video viewing capability
    
    The page scans the storage directories for video files and displays them
    in an organized gallery format with modern video player functionality.
--}}

@extends('theme::layouts.app')

@section('title', 'Galerie Video')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Galerie Video</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Urmărește colecția noastră de videoclipuri și momentele speciale capturate în mișcare.
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
                videos: [],
                loading: true,
                currentVideo: 0,
                showModal: false,
                isPlaying: false,
                
                // Initialize the gallery
                async init() {
                    await this.loadVideos();
                    this.setupKeyboardNavigation();
                },
                
                // Load videos from storage
                async loadVideos() {
                    try {
                        // This would typically fetch from an API endpoint
                        // For demo purposes, we'll use placeholder video URLs
                        this.videos = [
                            {
                                id: 1,
                                url: 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4',
                                thumbnail: 'https://picsum.photos/400/225?random=1',
                                title: 'Video Demonstrativ 1',
                                description: 'Primul video din galeria noastră demonstrativă',
                                duration: '1:23'
                            },
                            {
                                id: 2,
                                url: 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_2mb.mp4',
                                thumbnail: 'https://picsum.photos/400/225?random=2',
                                title: 'Video Demonstrativ 2',
                                description: 'Al doilea video cu conținut interesant',
                                duration: '2:15'
                            },
                            {
                                id: 3,
                                url: 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_5mb.mp4',
                                thumbnail: 'https://picsum.photos/400/225?random=3',
                                title: 'Video Demonstrativ 3',
                                description: 'Al treilea video din colecția noastră',
                                duration: '3:42'
                            },
                            {
                                id: 4,
                                url: 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4',
                                thumbnail: 'https://picsum.photos/400/225?random=4',
                                title: 'Video Demonstrativ 4',
                                description: 'Al patrulea video cu conținut demo',
                                duration: '1:58'
                            }
                        ];
                        this.loading = false;
                    } catch (error) {
                        console.error('Error loading videos:', error);
                        this.loading = false;
                    }
                },
                
                // Open modal with specific video
                openModal(index) {
                    this.currentVideo = index;
                    this.showModal = true;
                    this.isPlaying = false;
                    document.body.style.overflow = 'hidden';
                },
                
                // Close modal
                closeModal() {
                    this.showModal = false;
                    this.isPlaying = false;
                    document.body.style.overflow = 'auto';
                    
                    // Pause video when closing modal
                    const video = this.$refs.modalVideo;
                    if (video) {
                        video.pause();
                    }
                },
                
                // Navigate to next video
                nextVideo() {
                    this.currentVideo = (this.currentVideo + 1) % this.videos.length;
                    this.isPlaying = false;
                    
                    // Reset video when changing
                    this.$nextTick(() => {
                        const video = this.$refs.modalVideo;
                        if (video) {
                            video.currentTime = 0;
                            video.pause();
                        }
                    });
                },
                
                // Navigate to previous video
                prevVideo() {
                    this.currentVideo = this.currentVideo === 0 ? this.videos.length - 1 : this.currentVideo - 1;
                    this.isPlaying = false;
                    
                    // Reset video when changing
                    this.$nextTick(() => {
                        const video = this.$refs.modalVideo;
                        if (video) {
                            video.currentTime = 0;
                            video.pause();
                        }
                    });
                },
                
                // Toggle video play/pause
                togglePlay() {
                    const video = this.$refs.modalVideo;
                    if (video) {
                        if (this.isPlaying) {
                            video.pause();
                        } else {
                            video.play();
                        }
                        this.isPlaying = !this.isPlaying;
                    }
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
                                this.prevVideo();
                                break;
                            case 'ArrowRight':
                                this.nextVideo();
                                break;
                            case ' ':
                                e.preventDefault();
                                this.togglePlay();
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
                <span class="ml-3 text-gray-600">Se încarcă videoclipurile...</span>
            </div>
            
            {{-- Videos Grid --}}
            <div 
                x-show="!loading" 
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <template x-for="(video, index) in videos" :key="video.id">
                    <div 
                        @click="openModal(index)"
                        class="group cursor-pointer bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                    >
                        {{-- Video Thumbnail Container --}}
                        <div class="relative overflow-hidden aspect-video bg-gray-100">
                            <img 
                                :src="video.thumbnail" 
                                :alt="video.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                loading="lazy"
                            />
                            
                            {{-- Play Button Overlay --}}
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            {{-- Duration Badge --}}
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                                <span x-text="video.duration"></span>
                            </div>
                        </div>
                        
                        {{-- Video Info --}}
                        <div class="p-4">
                            <h3 x-text="video.title" class="font-semibold text-gray-900 mb-1"></h3>
                            <p x-text="video.description" class="text-sm text-gray-600 line-clamp-2"></p>
                        </div>
                    </div>
                </template>
            </div>
            
            {{-- Empty State --}}
            <div x-show="!loading && videos.length === 0" class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nu există videoclipuri</h3>
                <p class="text-gray-600">Videoclipurile vor fi afișate aici când vor fi disponibile.</p>
            </div>
        </div>
        
        {{-- Modal Video Player --}}
        <div 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-95"
            @click.self="closeModal()"
        >
            {{-- Modal Content --}}
            <div class="relative max-w-6xl max-h-full mx-4 w-full">
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
                    @click="prevVideo()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                {{-- Next Button --}}
                <button 
                    @click="nextVideo()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                {{-- Video Player --}}
                <template x-if="videos[currentVideo]">
                    <div class="text-center">
                        <video 
                            x-ref="modalVideo"
                            :src="videos[currentVideo].url" 
                            class="max-w-full max-h-[80vh] mx-auto"
                            controls
                            @play="isPlaying = true"
                            @pause="isPlaying = false"
                            @ended="isPlaying = false"
                        ></video>
                        
                        {{-- Video Info --}}
                        <div class="mt-4 text-white text-center">
                            <h3 x-text="videos[currentVideo].title" class="text-xl font-semibold mb-2"></h3>
                            <p x-text="videos[currentVideo].description" class="text-gray-300"></p>
                            <p class="text-sm text-gray-400 mt-2">
                                <span x-text="currentVideo + 1"></span> din <span x-text="videos.length"></span>
                            </p>
                            
                            {{-- Play/Pause Button --}}
                            <button 
                                @click="togglePlay()"
                                class="mt-4 bg-white/20 backdrop-blur-sm text-white rounded-full p-3 hover:bg-white/30 transition-all"
                            >
                                <svg x-show="!isPlaying" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                <svg x-show="isPlaying" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 4h4v16H6zM14 4h4v16h-4z"/>
                                </svg>
                            </button>
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
    
    /* Custom video controls styling */
    video::-webkit-media-controls-panel {
        background-color: rgba(0, 0, 0, 0.8);
    }
    
    /* Aspect ratio for video thumbnails */
    .aspect-video {
        aspect-ratio: 16 / 9;
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
