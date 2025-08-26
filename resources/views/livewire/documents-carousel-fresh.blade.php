<div 
    x-data="{
        currentSlide: 0,
        documents: {{ json_encode($documents->toArray()) }},
        cardsPerView: window.innerWidth >= 1024 ? 2 : 1,
        autoplay: true,
        autoplayDelay: 4000,
        autoplayTimer: null,
        
        init() {
            this.updateCardsPerView();
            if (this.autoplay && this.documents.length > this.cardsPerView) {
                this.startAutoplay();
            }
            window.addEventListener('resize', () => {
                this.updateCardsPerView();
            });
        },
        
        updateCardsPerView() {
            this.cardsPerView = window.innerWidth >= 1024 ? 2 : 1;
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
            if (this.autoplay && this.documents.length > this.cardsPerView) {
                this.startAutoplay();
            }
        },
        
        nextSlide() {
            const maxSlide = Math.max(0, this.documents.length - this.cardsPerView);
            this.currentSlide = this.currentSlide >= maxSlide ? 0 : this.currentSlide + 1;
        },
        
        prevSlide() {
            const maxSlide = Math.max(0, this.documents.length - this.cardsPerView);
            this.currentSlide = this.currentSlide === 0 ? maxSlide : this.currentSlide - 1;
        },
        
        goToSlide(index) {
            this.currentSlide = index;
            this.restartAutoplay();
        },
        
        get totalSlides() {
            return Math.max(1, this.documents.length - this.cardsPerView + 1);
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="restartAutoplay()"
    class="relative w-full h-[400px] lg:h-[450px] overflow-hidden rounded-2xl bg-gradient-to-br from-white to-zinc-50 shadow-2xl border border-zinc-200/60"
>
    {{-- Header with title --}}
    <div class="absolute top-0 left-0 right-0 bg-gradient-to-b from-black/20 to-transparent p-6 z-20">
        <h2 class="text-2xl font-bold text-white drop-shadow-lg">Documente recente</h2>
    </div>

    {{-- Main carousel container --}}
    <div class="relative w-full h-full bg-gradient-to-br from-zinc-50 to-white p-6 pt-20">
        <div class="relative w-full h-full overflow-hidden">
            <div 
                class="flex transition-transform duration-500 ease-in-out h-full"
                :style="`transform: translateX(-${currentSlide * (100 / cardsPerView)}%)`"
            >
                @if(count($documents) > 0)
                    @foreach($documents as $document)
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-4 h-full flex flex-col group cursor-pointer border border-gray-100 hover:border-blue-200"
                                 onclick="window.location='{{ route('documents.show', $document->id) }}'">
                                
                                {{-- Document Header --}}
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        @if($document->category)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white"
                                                  style="background-color: {{ $document->category->color }}">
                                                {{ $document->category->name }}
                                            </span>
                                        @endif
                                        <time class="text-xs text-gray-500">{{ $document->created_at->format('d.m.Y') }}</time>
                                    </div>
                                    
                                    @php
                                        $fileUrls = $document->getFileUrls();
                                    @endphp
                                    @if(count($fileUrls) > 1)
                                        <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                                            {{ count($fileUrls) }} fișiere
                                        </span>
                                    @endif
                                </div>

                                {{-- Document Title --}}
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200 text-base">
                                    {{ $document->title }}
                                </h3>

                                {{-- Document Description --}}
                                @if($document->description)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2 flex-grow">
                                        {{ $document->description }}
                                    </p>
                                @endif

                                {{-- File Count Info --}}
                                @if(count($fileUrls) > 0)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg text-sm mt-auto">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span class="text-gray-600 font-medium">
                                            {{ count($fileUrls) }} {{ count($fileUrls) == 1 ? 'fișier atașat' : 'fișiere atașate' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Empty State --}}
                    <div class="flex items-center justify-center h-full text-gray-500 w-full">
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="mt-2 text-lg text-gray-500 font-medium">Nu sunt documente disponibile</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Navigation arrows --}}
    <template x-if="documents.length > cardsPerView">
        <div>
            {{-- Previous button --}}
            <button 
                @click="prevSlide(); restartAutoplay();"
                class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white rounded-full p-3 transition-all duration-300 hover:scale-110 z-30 shadow-lg"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>
            
            {{-- Next button --}}
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
    <template x-if="documents.length > cardsPerView">
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-3 z-30">
            <div class="bg-black/20 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                <template x-for="(dot, index) in Array.from({length: totalSlides})" :key="index">
                    <button
                        @click="goToSlide(index)"
                        :class="currentSlide === index ? 'bg-blue-500 scale-125 shadow-lg shadow-blue-500/50' : 'bg-white/60 hover:bg-white/80'"
                        class="w-3 h-3 rounded-full transition-all duration-300 mx-1 hover:scale-110"
                    ></button>
                </template>
            </div>
        </div>
    </template>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</div>
                
                @if(count($documents) > 0)
                    @foreach($documents as $document)
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-3 h-full flex flex-col group cursor-pointer border border-gray-100 hover:border-blue-200"
                                 onclick="window.location='{{ route('documents.show', $document->id) }}'">
                                
                                <!-- Document Header -->
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        @if($document->category)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white"
                                                  style="background-color: {{ $document->category->color }}">
                                                {{ $document->category->name }}
                                            </span>
                                        @endif
                                        <time class="text-xs text-gray-500">{{ $document->created_at->format('d.m.Y') }}</time>
                                    </div>
                                    
                                    @php
                                        $fileUrls = $document->getFileUrls();
                                    @endphp
                                    @if(count($fileUrls) > 1)
                                        <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                                            {{ count($fileUrls) }} fișiere
                                        </span>
                                    @endif
                                </div>

                                <!-- Document Title -->
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200 text-sm">
                                    {{ $document->title }}
                                </h3>

                                <!-- Document Description -->
                                @if($document->description)
                                    <p class="text-xs text-gray-600 mb-2 line-clamp-2 flex-grow">
                                        {{ $document->description }}
                                    </p>
                                @endif

                                <!-- File Count Info -->
                                @if(count($fileUrls) > 0)
                                    <div class="flex items-center p-2 bg-gray-50 rounded text-xs mt-auto">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span class="text-gray-600">
                                            {{ count($fileUrls) }} {{ count($fileUrls) == 1 ? 'fișier atașat' : 'fișiere atașate' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Empty State -->
                    <div class="flex items-center justify-center h-full text-gray-500">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Nu sunt documente disponibile</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Navigation Dots -->
    @if($documents->count() > 2)
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
            @for($i = 0; $i < max(1, $documents->count() - 1); $i++)
                <button @click="currentIndex = {{ $i }}; stopAutoPlay(); startAutoPlay();" 
                        class="w-2 h-2 rounded-full transition-colors duration-200"
                        :class="currentIndex === {{ $i }} ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'">
                </button>
            @endfor
        </div>
    @endif

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</div>
                
                @if(count($documents) > 0)
                    @foreach($documents as $document)
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-3 h-full flex flex-col group cursor-pointer border border-gray-100 hover:border-blue-200"
                                 onclick="window.location='{{ route('documents.show', $document->id) }}'">
                                
                                <!-- Document Header -->
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        @if($document->category)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white"
                                                  style="background-color: {{ $document->category->color }}">
                                                {{ $document->category->name }}
                                            </span>
                                        @endif
                                        <time class="text-xs text-gray-500">{{ $document->created_at->format('d.m.Y') }}</time>
                                    </div>
                                    
                                    @php
                                        $fileUrls = $document->getFileUrls();
                                    @endphp
                                    @if(count($fileUrls) > 1)
                                        <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                                            {{ count($fileUrls) }} fișiere
                                        </span>
                                    @endif
                                </div>

                                <!-- Document Title -->
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200 text-sm">
                                    {{ $document->title }}
                                </h3>

                                <!-- Document Description -->
                                @if($document->description)
                                    <p class="text-xs text-gray-600 mb-2 line-clamp-2 flex-grow">
                                        {{ $document->description }}
                                    </p>
                                @endif

                                <!-- File Count Info -->
                                @if(count($fileUrls) > 0)
                                    <div class="flex items-center p-2 bg-gray-50 rounded text-xs mt-auto">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span class="text-gray-600">
                                            {{ count($fileUrls) }} {{ count($fileUrls) == 1 ? 'fișier atașat' : 'fișiere atașate' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Empty State -->
                    <div class="flex items-center justify-center h-full text-gray-500">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Nu sunt documente disponibile</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Navigation Dots -->
    @if($documents->count() > 2)
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
            @for($i = 0; $i < max(1, $documents->count() - 1); $i++)
                <button @click="currentIndex = {{ $i }}; stopAutoPlay(); startAutoPlay();" 
                        class="w-2 h-2 rounded-full transition-colors duration-200"
                        :class="currentIndex === {{ $i }} ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'">
                </button>
            @endfor
        </div>
    @endif

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</div>