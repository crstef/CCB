@props([
    'items' => [],
    'height' => 'h-96',
    'autoplay' => true,
    'autoplayDelay' => 5000,
    'showDots' => true,
    'showArrows' => true,
    'photoGalleryRoute' => '/galerie-foto',
    'videoGalleryRoute' => '/galerie-video'
])

<div 
    x-data="{
        currentSlide: 0,
        items: {{ json_encode($items) }},
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        autoplayDelay: {{ $autoplayDelay }},
        autoplayTimer: null,
        
        init() {
            if (this.autoplay && this.items.length > 1) {
                this.startAutoplay();
            }
        },
        
        startAutoplay() {
            this.autoplayTimer = setInterval(() => {
                this.nextSlide();
            }, this.autoplayDelay);
        },
        
        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        },
        
        restartAutoplay() {
            this.stopAutoplay();
            if (this.autoplay && this.items.length > 1) {
                this.startAutoplay();
            }
        },
        
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.items.length;
        },
        
        prevSlide() {
            this.currentSlide = this.currentSlide === 0 ? this.items.length - 1 : this.currentSlide - 1;
        },
        
        goToSlide(index) {
            this.currentSlide = index;
            this.restartAutoplay();
        },
        
        isVideo(item) {
            if (item.type) {
                return item.type.includes('video') || item.type.includes('mp4') || item.type.includes('webm') || item.type.includes('ogg');
            }
            if (item.url) {
                return /\.(mp4|webm|ogg|mov|avi|wmv)$/i.test(item.url);
            }
            return false;
        },
        
        isImage(item) {
            if (item.type) {
                return item.type.includes('image');
            }
            if (item.url) {
                return /\.(jpg|jpeg|png|gif|bmp|svg|webp)$/i.test(item.url);
            }
            return false;
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="restartAutoplay()"
    class="relative w-full {{ $height }} overflow-hidden rounded-2xl bg-gray-100 shadow-xl"
>
    <!-- Main Carousel Container -->
    <div class="relative w-full h-full">
        <template x-for="(item, index) in items" :key="index">
            <div 
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-105"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute inset-0 w-full h-full"
            >
                <!-- Image Display -->
                <template x-if="isImage(item)">
                    <div class="relative w-full h-full group">
                        <img 
                            :src="item.url" 
                            :alt="item.title || item.name || 'Gallery image'"
                            class="w-full h-full object-cover"
                        />
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        
                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 x-text="item.title || item.name || 'Fotografie'" class="text-xl font-bold mb-2"></h3>
                            <p x-text="item.description || 'Vedere din galeria foto'" class="text-sm opacity-90 mb-4"></p>
                            
                            <!-- Action Button for Photos -->
                            <a href="{{ $photoGalleryRoute }}" class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-white hover:bg-white/30 transition-all duration-200 border border-white/20">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Vezi galeria foto
                            </a>
                        </div>
                    </div>
                </template>
                
                <!-- Video Display -->
                <template x-if="isVideo(item)">
                    <div class="relative w-full h-full group">
                        <video 
                            :src="item.url"
                            class="w-full h-full object-cover"
                            muted
                            loop
                            autoplay
                            playsinline
                        ></video>
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        
                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 x-text="item.title || item.name || 'Video'" class="text-xl font-bold mb-2"></h3>
                            <p x-text="item.description || 'Vedere din galeria video'" class="text-sm opacity-90 mb-4"></p>
                            
                            <!-- Action Button for Videos -->
                            <a href="{{ $videoGalleryRoute }}" class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-white hover:bg-white/30 transition-all duration-200 border border-white/20">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V17M6 10h2m6 0h2m-7 4h2m3 0h2"></path>
                                </svg>
                                Vezi galeria video
                            </a>
                        </div>
                        
                        <!-- Play Icon Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
    
    @if($showArrows && count($items) > 1)
    <!-- Navigation Arrows -->
    <button 
        @click="prevSlide(); restartAutoplay();"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-full p-3 transition-all duration-200 group"
    >
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    
    <button 
        @click="nextSlide(); restartAutoplay();"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-full p-3 transition-all duration-200 group"
    >
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    @endif
    
    @if($showDots && count($items) > 1)
    <!-- Dots Navigation -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
        <template x-for="(item, index) in items" :key="index">
            <button
                @click="goToSlide(index)"
                :class="currentSlide === index ? 'bg-white' : 'bg-white/50'"
                class="w-2 h-2 rounded-full transition-all duration-200 hover:bg-white/75"
            ></button>
        </template>
    </div>
    @endif
    
    <!-- Media Type Indicator -->
    <div class="absolute top-4 right-4">
        <template x-for="(item, index) in items" :key="index">
            <div x-show="currentSlide === index" class="bg-black/50 backdrop-blur-sm rounded-full px-3 py-1 text-white text-xs flex items-center">
                <template x-if="isImage(item)">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Foto
                    </div>
                </template>
                <template x-if="isVideo(item)">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Video
                    </div>
                </template>
            </div>
        </template>
    </div>
    
    <!-- Loading State -->
    <template x-if="items.length === 0">
        <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
            <div class="text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-500">Se încarcă media...</p>
            </div>
        </div>
    </template>
</div>
