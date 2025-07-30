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
                const video = this.$el.querySelector(`video[data-slide='${this.currentSlide}']`);
                if (video) {
                    video.currentTime = 0;
                    video.play().catch(() => {});
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
    class="relative w-full h-[400px] lg:h-[450px] overflow-hidden rounded-2xl bg-gradient-to-br from-white to-zinc-50 shadow-2xl border border-zinc-200/60 backdrop-blur-sm"
    style="aspect-ratio: 16/9; min-height: 250px;"
>
    {{-- Premium glassmorphism overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-white/5 pointer-events-none z-10"></div>
    
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
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        
                        {{-- Content overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-20">
                            <div class="backdrop-blur-sm bg-black/20 rounded-xl p-4 border border-white/10">
                                <h3 x-text="item.title || 'Fotografie'" class="text-xl font-bold mb-2 text-white drop-shadow-lg"></h3>
                                <p x-text="item.description || 'Vedere din galeria foto'" class="text-sm opacity-90 text-zinc-100"></p>
                            </div>
                        </div>
                    </div>
                </template>
                
                {{-- Video display --}}
                <template x-if="isVideo(item)">
                    <div class="relative w-full h-full group">
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
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        
                        {{-- Video play indicator --}}
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="bg-blue-600/20 backdrop-blur-sm rounded-full p-6 group-hover:scale-110 transition-all duration-300 border border-blue-400/30">
                                <svg class="w-12 h-12 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Content overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-20">
                            <div class="backdrop-blur-sm bg-black/20 rounded-xl p-4 border border-white/10">
                                <h3 x-text="item.title || 'Video'" class="text-xl font-bold mb-2 text-white drop-shadow-lg"></h3>
                                <p x-text="item.description || 'Vedere din galeria video'" class="text-sm opacity-90 text-zinc-100"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
    
    {{-- Navigation arrows --}}
    <template x-if="items.length > 1">
        <div>
            {{-- Previous button --}}
            <button 
                @click="prevSlide(); restartAutoplay();"
                class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-blue-600/80 text-white rounded-xl p-4 transition-all duration-300 group border border-white/20 hover:border-blue-400/50 shadow-lg hover:shadow-blue-500/25 hover:scale-110 z-30"
            >
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            {{-- Next button --}}
            <button 
                @click="nextSlide(); restartAutoplay();"
                class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-blue-600/80 text-white rounded-xl p-4 transition-all duration-300 group border border-white/20 hover:border-blue-400/50 shadow-lg hover:shadow-blue-500/25 hover:scale-110 z-30"
            >
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
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
    
    {{-- Media type indicator --}}
    <template x-if="items.length > 0">
        <div class="absolute top-6 right-6 z-30">
            <template x-for="(item, index) in items" :key="index">
                <div x-show="currentSlide === index" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-75"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="bg-black/30 backdrop-blur-md rounded-xl px-4 py-2 text-white text-sm flex items-center border border-white/20 shadow-lg">
                    {{-- Photo indicator --}}
                    <template x-if="isImage(item)">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-2 animate-pulse"></div>
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">Fotografie</span>
                        </div>
                    </template>
                    {{-- Video indicator --}}
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
