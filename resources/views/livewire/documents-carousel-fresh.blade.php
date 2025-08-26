<div class="relative h-full w-full group"
     x-data="{
        currentIndex: 0,
        cardsPerView: window.innerWidth >= 1024 ? 2 : 1,
        autoplayInterval: null,
        isPaused: false,
        
        init() {
            this.startAutoPlay();
            window.addEventListener('resize', () => {
                this.cardsPerView = window.innerWidth >= 1024 ? 2 : 1;
            });
        },
        
        startAutoPlay() {
            if ({{ count($documents) }} <= this.cardsPerView) return;
            
            this.autoplayInterval = setInterval(() => {
                if (!this.isPaused) {
                    this.nextSlide();
                }
            }, 4000);
        },
        
        stopAutoPlay() {
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
                this.autoplayInterval = null;
            }
        },
        
        nextSlide() {
            if ({{ count($documents) }} <= this.cardsPerView) return;
            
            const maxIndex = {{ count($documents) }} - this.cardsPerView;
            this.currentIndex = this.currentIndex >= maxIndex ? 0 : this.currentIndex + 1;
        },
        
        prevSlide() {
            if ({{ count($documents) }} <= this.cardsPerView) return;
            
            const maxIndex = {{ count($documents) }} - this.cardsPerView;
            this.currentIndex = this.currentIndex <= 0 ? maxIndex : this.currentIndex - 1;
        }
     }"
     @mouseenter="isPaused = true"
     @mouseleave="isPaused = false">

    <!-- Documents Content -->
    <div class="h-full relative">
        <!-- Navigation Arrows - Only show if more than 2 documents -->
        @if(count($documents) > 2)
            <div class="absolute top-1/2 left-4 transform -translate-y-1/2 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <button @click="prevSlide(); stopAutoPlay(); startAutoPlay();" 
                        class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            </div>
            <div class="absolute top-1/2 right-4 transform -translate-y-1/2 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <button @click="nextSlide(); stopAutoPlay(); startAutoPlay();" 
                        class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        @endif
    </div>
    
    <!-- Carousel Container -->
    <div class="pt-24 pb-4 px-4 h-full">
        <div class="overflow-hidden h-full">
            <div class="flex transition-transform duration-500 ease-in-out h-full"
                 :style="`transform: translateX(-${currentIndex * (100 / cardsPerView)}%)`">
                
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