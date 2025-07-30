{{--
    Premium Media Carousel Component for Wave Anchor Theme
    
    Enhanced with:
    - Premium Wave Anchor styling with gradients and shadows
    - Random slide transitions for dynamic visual experience  
    - Automatic video playback when slide is active
    - Improved responsive design and accessibility
    - Premium glassmorphism effects and smooth animations
    
    @param array $items - Array of media items to display
    @param string $height - Tailwind CSS height classes (default: h-96)
    @param bool $autoplay - Enable/disable auto-playing slideshow
    @param int $autoplayDelay - Time in milliseconds between slides
    @param bool $showDots - Show/hide dot navigation indicators
    @param bool $showArrows - Show/hide arrow navigation buttons
    @param string $photoGalleryRoute - URL route for photo gallery page
    @param string $videoGalleryRoute - URL route for video gallery page
--}}

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
        // Current slide index
        currentSlide: 0,
        
        // Media items array from Laravel
        items: {{ json_encode($items) }},
        
        // Autoplay configuration
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        autoplayDelay: {{ $autoplayDelay }},
        autoplayTimer: null,
        
        // Random transition effects for premium feel
        transitionEffects: [
            'fade',
            'slideLeft',
            'slideRight', 
            'slideUp',
            'slideDown',
            'scale',
            'rotate'
        ],
        currentTransition: 'fade',
        
        // Initialize component when Alpine.js loads
        init() {
            if (this.autoplay && this.items.length > 1) {
                this.startAutoplay();
            }
            // Start video on current slide if it's a video
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
        },
        
        // Start the autoplay timer
        startAutoplay() {
            this.autoplayTimer = setInterval(() => {
                this.nextSlide();
            }, this.autoplayDelay);
        },
        
        // Stop the autoplay timer
        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        },
        
        // Restart autoplay (used when user manually navigates)
        restartAutoplay() {
            this.stopAutoplay();
            if (this.autoplay && this.items.length > 1) {
                this.startAutoplay();
            }
        },
        
        // Navigate to next slide with random transition
        nextSlide() {
            this.pauseCurrentVideo();
            this.setRandomTransition();
            this.currentSlide = (this.currentSlide + 1) % this.items.length;
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
        },
        
        // Navigate to previous slide with random transition
        prevSlide() {
            this.pauseCurrentVideo();
            this.setRandomTransition();
            this.currentSlide = this.currentSlide === 0 ? this.items.length - 1 : this.currentSlide - 1;
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
        },
        
        // Navigate to specific slide by index
        goToSlide(index) {
            if (index !== this.currentSlide) {
                this.pauseCurrentVideo();
                this.setRandomTransition();
                this.currentSlide = index;
                this.$nextTick(() => {
                    this.playCurrentVideo();
                });
                this.restartAutoplay();
            }
        },
        
        // Set random transition effect
        setRandomTransition() {
            const randomIndex = Math.floor(Math.random() * this.transitionEffects.length);
            this.currentTransition = this.transitionEffects[randomIndex];
        },
        
        // Play video for current slide
        playCurrentVideo() {
            if (this.isVideo(this.items[this.currentSlide])) {
                const video = this.$el.querySelector(`[data-slide-index='${this.currentSlide}'] video`);
                if (video) {
                    video.currentTime = 0;
                    video.play().catch(() => {});
                }
            }
        },
        
        // Pause video for current slide
        pauseCurrentVideo() {
            const video = this.$el.querySelector(`[data-slide-index='${this.currentSlide}'] video`);
            if (video) {
                video.pause();
            }
        },
        
        // Check if media item is a video file
        isVideo(item) {
            if (item.type) {
                return item.type.includes('video') || item.type.includes('mp4') || item.type.includes('webm') || item.type.includes('ogg');
            }
            if (item.url) {
                return /\.(mp4|webm|ogg|mov|avi|wmv)$/i.test(item.url);
            }
            return false;
        },
        
        // Check if media item is an image file
        isImage(item) {
            if (item.type) {
                return item.type.includes('image');
            }
            if (item.url) {
                return /\.(jpg|jpeg|png|gif|bmp|svg|webp)$/i.test(item.url);
            }
            return false;
        },
        
        // Get transition classes based on current effect
        getTransitionClasses(isEntering) {
            const effects = {
                fade: isEntering 
                    ? 'opacity-0 scale-105' 
                    : 'opacity-100 scale-100',
                slideLeft: isEntering 
                    ? 'opacity-0 transform translate-x-full' 
                    : 'opacity-100 transform translate-x-0',
                slideRight: isEntering 
                    ? 'opacity-0 transform -translate-x-full' 
                    : 'opacity-100 transform translate-x-0',
                slideUp: isEntering 
                    ? 'opacity-0 transform translate-y-full' 
                    : 'opacity-100 transform translate-y-0',
                slideDown: isEntering 
                    ? 'opacity-0 transform -translate-y-full' 
                    : 'opacity-100 transform translate-y-0',
                scale: isEntering 
                    ? 'opacity-0 transform scale-50' 
                    : 'opacity-100 transform scale-100',
                rotate: isEntering 
                    ? 'opacity-0 transform rotate-180 scale-75' 
                    : 'opacity-100 transform rotate-0 scale-100'
            };
            return effects[this.currentTransition] || effects.fade;
        }
    }"
    {{-- Pause autoplay on hover, resume when mouse leaves --}}
    @mouseenter="stopAutoplay()"
    @mouseleave="restartAutoplay()"
    class="relative w-full {{ $height }} overflow-hidden rounded-2xl bg-gradient-to-br from-white to-zinc-50 shadow-2xl border border-zinc-200/60 backdrop-blur-sm"
    style="aspect-ratio: 16/9; min-height: 250px;"
>
    {{-- Premium glassmorphism overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-white/5 pointer-events-none z-10"></div>
    
    {{-- Main carousel container with relative positioning --}}
    <div class="relative w-full h-full min-h-full bg-gradient-to-br from-zinc-50 to-white">
        {{-- Loop through all media items --}}
        <template x-for="(item, index) in items" :key="index">
            {{-- Individual slide container with enhanced transitions --}}
            <div 
                x-show="currentSlide === index"
                :data-slide-index="index"
                x-transition:enter="transition ease-out duration-500"
                :x-transition:enter-start="getTransitionClasses(true)"
                :x-transition:enter-end="getTransitionClasses(false)"
                x-transition:leave="transition ease-in duration-400"
                :x-transition:leave-start="getTransitionClasses(false)"
                :x-transition:leave-end="getTransitionClasses(true)"
                class="absolute inset-0 w-full h-full overflow-hidden"
            >
                {{-- Image display template --}}
                <template x-if="isImage(item)">
                    <div class="relative w-full h-full group">
                        {{-- Main image with premium styling --}}
                        <img 
                            :src="item.url" 
                            :alt="item.title || item.name || 'Gallery image'"
                            class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                            style="min-height: 100%; min-width: 100%;"
                        />
                        {{-- Premium gradient overlay with Wave theme colors --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        
                        {{-- Content overlay with title and description only --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-20">
                            <div class="backdrop-blur-sm bg-black/20 rounded-xl p-4 border border-white/10">
                                <h3 x-text="item.title || 'Fotografie'" class="text-xl font-bold mb-2 text-white drop-shadow-lg"></h3>
                                <p x-text="item.description || 'Vedere din galeria foto'" class="text-sm opacity-90 text-zinc-100"></p>
                            </div>
                        </div>
                    </div>
                </template>
                
                {{-- Video display template with automatic playback --}}
                <template x-if="isVideo(item)">
                    <div class="relative w-full h-full group">
                        {{-- Main video element with enhanced controls --}}
                        <video 
                            :src="item.url"
                            class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                            style="min-height: 100%; min-width: 100%;"
                            muted
                            loop
                            playsinline
                            preload="metadata"
                            x-ref="'video_' + index"
                        ></video>
                        
                        {{-- Premium gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        
                        {{-- Video play indicator overlay --}}
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="bg-blue-600/20 backdrop-blur-sm rounded-full p-6 group-hover:scale-110 transition-all duration-300 border border-blue-400/30">
                                <svg class="w-12 h-12 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Content overlay with title and description only --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-20">
                            <div class="backdrop-blur-sm bg-black/20 rounded-xl p-4 border border-white/10">
                                <h3 x-text="item.title || 'Video'" class="text-xl font-bold mb-2 text-white drop-shadow-lg"></h3>
                                <p x-text="item.description || 'Vedere din galeria video'" class="text-sm opacity-90 text-zinc-100"></p>
                            </div>
                        </div>
                    </div>
                </template>
                                </svg>
                                Vezi galeria video
                            </a>
                        </div>
                        
                        {{-- Play icon overlay for visual indication --}}
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
    
    {{-- Premium Navigation arrows with Wave theme styling --}}
    @if($showArrows && count($items) > 1)
    {{-- Previous slide button with enhanced styling --}}
    <button 
        @click="prevSlide(); restartAutoplay();"
        class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-blue-600/80 text-white rounded-xl p-4 transition-all duration-300 group border border-white/20 hover:border-blue-400/50 shadow-lg hover:shadow-blue-500/25 hover:scale-110 z-30"
    >
        <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    
    {{-- Next slide button with enhanced styling --}}
    <button 
        @click="nextSlide(); restartAutoplay();"
        class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-blue-600/80 text-white rounded-xl p-4 transition-all duration-300 group border border-white/20 hover:border-blue-400/50 shadow-lg hover:shadow-blue-500/25 hover:scale-110 z-30"
    >
        <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    @endif
    
    {{-- Premium Dot navigation indicators with enhanced styling --}}
    @if($showDots && count($items) > 1)
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-3 z-30">
        <div class="bg-black/20 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
            <template x-for="(item, index) in items" :key="index">
                <button
                    @click="goToSlide(index)"
                    :class="currentSlide === index ? 'bg-blue-500 scale-125 shadow-lg shadow-blue-500/50' : 'bg-white/60 hover:bg-white/80'"
                    class="w-3 h-3 rounded-full transition-all duration-300 mx-1 hover:scale-110"
                ></button>
            </template>
        </div>
    </div>
    @endif
            ></button>
        </template>
    </div>
    @endif
    
    {{-- Premium media type indicator badge --}}
    <div class="absolute top-6 right-6 z-30">
        <template x-for="(item, index) in items" :key="index">
            <div x-show="currentSlide === index" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-75"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-black/30 backdrop-blur-md rounded-xl px-4 py-2 text-white text-sm flex items-center border border-white/20 shadow-lg">
                {{-- Photo indicator with Wave theme colors --}}
                <template x-if="isImage(item)">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-2 animate-pulse"></div>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Fotografie</span>
                    </div>
                </template>
                {{-- Video indicator with animation --}}
                <template x-if="isVideo(item)">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mr-2 animate-pulse"></div>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Video</span>
                    </div>
                </template>
            </div>
        </template>
    </div>
    
    {{-- Premium loading state with Wave theme styling --}}
    <template x-if="items.length === 0">
        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-zinc-50 to-white">
            <div class="text-center p-8">
                {{-- Animated loading icon --}}
                <div class="relative mb-6">
                    <svg class="w-16 h-16 mx-auto text-blue-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <div class="absolute inset-0 w-16 h-16 mx-auto border-4 border-blue-200 border-t-blue-500 rounded-full animate-spin"></div>
                </div>
                {{-- Loading text with premium typography --}}
                <h3 class="text-xl font-bold text-zinc-800 mb-2">Se încarcă galeria media</h3>
                <p class="text-zinc-600 max-w-sm mx-auto">Pregătim cele mai frumoase imagini și videouri pentru tine...</p>
            </div>
        </div>
    </template>
</div>
                <p class="text-gray-500">Se încarcă media...</p>
            </div>
        </div>
    </template>
</div>
