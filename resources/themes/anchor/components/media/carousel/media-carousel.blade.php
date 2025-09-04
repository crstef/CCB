{{--
    Premium Media Carousel Component for Wave Anchor Theme
    Livewire Component Template - Single Root Element Structure
--}}

<div 
    x-data="{
        currentSlide: 0,
        items: {{ json_encode($items) }},
        autoplay: true,
        autoplayDelay: 5000,
        autoplayTimer: null,
        
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
        
        init() {
            if (this.autoplay && this.items.length > 1) {
                this.startAutoplay();
            }
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
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
            this.pauseCurrentVideo();
            this.setRandomTransition();
            this.currentSlide = (this.currentSlide + 1) % this.items.length;
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
        },
        
        prevSlide() {
            this.pauseCurrentVideo();
            this.setRandomTransition();
            this.currentSlide = this.currentSlide === 0 ? this.items.length - 1 : this.currentSlide - 1;
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
        },
        
        goToSlide(index) {
            this.pauseCurrentVideo();
            this.setRandomTransition();
            this.currentSlide = index;
            this.restartAutoplay();
            this.$nextTick(() => {
                this.playCurrentVideo();
            });
        },
        
        setRandomTransition() {
            const randomIndex = Math.floor(Math.random() * this.transitionEffects.length);
            this.currentTransition = this.transitionEffects[randomIndex];
        },
        
        isImage(item) {
            if (item.type) {
                return item.type.includes('image');
            }
            if (item.url) {
                return /\.(jpg|jpeg|png|gif|bmp|svg|webp)$/i.test(item.url);
            }
            return false;
        },
        
        isVideo(item) {
            if (item.type) {
                return item.type.includes('video');
            }
            if (item.url) {
                return /\.(mp4|webm|ogg|mov|avi|wmv)$/i.test(item.url);
            }
            return false;
        },
        
        playCurrentVideo() {
            const currentItem = this.items[this.currentSlide];
            if (this.isVideo(currentItem)) {
                // Pentru YouTube videos, deschide într-o fereastră nouă
                if (currentItem.url && (currentItem.url.includes('youtube.com') || currentItem.url.includes('youtu.be'))) {
                    window.open(currentItem.url, '_blank');
                } else {
                    // Pentru videoclipuri locale, reda în carousel
                    const video = this.$el.querySelector(`video[data-slide='${this.currentSlide}']`);
                    if (video) {
                        video.currentTime = 0;
                        video.play().catch(() => {});
                    }
                }
            }
        },
        
        pauseCurrentVideo() {
            const videos = this.$el.querySelectorAll('video');
            videos.forEach(video => {
                video.pause();
            });
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="restartAutoplay()"
    class="relative w-full h-[400px] lg:h-[450px] overflow-hidden rounded-2xl bg-gradient-to-br from-white to-zinc-50 shadow-2xl border border-zinc-200/60"
    style="aspect-ratio: 16/9; min-height: 250px;"
>
    {{-- Main carousel container --}}
    <div class="relative w-full h-full min-h-full bg-gradient-to-br from-zinc-50 to-white">
        {{-- Loop through all media items --}}
        <template x-for="(item, index) in items" :key="index">
            {{-- Individual slide container --}}
            <div 
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-400"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 w-full h-full overflow-hidden"
            >
                {{-- Image display --}}
                <template x-if="isImage(item)">
                    <div class="relative w-full h-full group">
                        <img 
                            :src="item.url" 
                            :alt="item.title || 'Gallery image'"
                            class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                            style="min-height: 100%; min-width: 100%;"
                        />
                        
                        {{-- Small title and description at bottom with very transparent background --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-black/15 p-3 text-white z-20">
                            <h4 x-text="item.title || 'Fotografie'" class="text-sm font-semibold text-white drop-shadow-lg"></h4>
                            <p x-text="item.description || 'Imagine din galeria foto'" class="text-xs text-white opacity-95 mt-1 drop-shadow-md"></p>
                        </div>
                    </div>
                </template>
                
                {{-- Video display --}}
                <template x-if="isVideo(item)">
                    <div class="relative w-full h-full group cursor-pointer" @click="playCurrentVideo()">
                        {{-- Thumbnail pentru YouTube --}}
                        <template x-if="item.url && (item.url.includes('youtube.com') || item.url.includes('youtu.be'))">
                            <div class="w-full h-full">
                                <img 
                                    :src="(() => {
                                        let videoId = '';
                                        if (item.url.includes('youtube.com/watch?v=')) {
                                            videoId = item.url.split('v=')[1].split('&')[0];
                                        } else if (item.url.includes('youtu.be/')) {
                                            videoId = item.url.split('youtu.be/')[1].split('?')[0];
                                        }
                                        return videoId ? 'https://img.youtube.com/vi/' + videoId + '/hqdefault.jpg' : '';
                                    })()"
                                    :alt="item.title || 'YouTube thumbnail'"
                                    class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                                    style="min-height: 100%; min-width: 100%;"
                                    @error="$el.src = 'https://via.placeholder.com/480x360/cccccc/666666?text=Video'"
                                />
                            </div>
                        </template>
                        
                        {{-- Video local cu preload pentru thumbnail --}}
                        <template x-if="!item.url || (!item.url.includes('youtube.com') && !item.url.includes('youtu.be'))">
                            <video 
                                :src="item.url"
                                :data-slide="index"
                                class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                                style="min-height: 100%; min-width: 100%;"
                                muted
                                loop
                                playsinline
                                preload="metadata"
                            ></video>
                        </template>
                        
                        {{-- Play Button Overlay - cu pointer-events-none --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 pointer-events-none">
                            <div class="bg-white/90 backdrop-blur-sm rounded-full p-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Small title and description at bottom --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-black/10 p-3 text-white z-20 pointer-events-none">
                            <h4 x-text="item.title || 'Video'" class="text-sm font-semibold text-white drop-shadow-lg"></h4>
                            <p x-text="item.description || 'Video din galeria multimedia'" class="text-xs text-white opacity-95 mt-1 drop-shadow-md"></p>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
    
    {{-- Navigation arrows --}}
    <template x-if="items.length > 1">
        <div>
            {{-- Previous button - Left Arrow < --}}
            <button 
                @click="prevSlide(); restartAutoplay();"
                class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white rounded-full p-3 transition-all duration-300 hover:scale-110 z-30 shadow-lg"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>
            
            {{-- Next button - Right Arrow > --}}
            <button 
                @click="nextSlide(); restartAutoplay();"
                class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white rounded-full p-3 transition-all duration-300 hover:scale-110 z-30 shadow-lg"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 18l6-6-6-6"></path>
                </svg>
            </button>
        </div>
    </template>
    
    {{-- Dot navigation --}}
    <template x-if="items.length > 1">
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
    </template>
    
    {{-- Loading state --}}
    <template x-if="items.length === 0">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center p-8">
                <div class="relative mb-6">
                    <svg class="w-16 h-16 mx-auto text-blue-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <div class="absolute inset-0 w-16 h-16 mx-auto border-4 border-blue-200 border-t-blue-500 rounded-full animate-spin"></div>
                </div>
                <h3 class="text-xl font-bold text-zinc-800 mb-2">Se încarcă galeria media</h3>
                <p class="text-zinc-600 max-w-sm mx-auto">Pregătim cele mai frumoase imagini și videouri pentru tine...</p>
            </div>
        </div>
    </template>
</div>
