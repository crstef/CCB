<div 
    x-data="{ 
        currentIndex: 0,
        autoPlay: @entangle('autoPlay'),
        autoPlayInterval: null,
        documentsCount: {{ $documents->count() }},
        cardsPerView: 2,
        init() {
            this.updateCardsPerView();
            this.startAutoPlay();
            window.addEventListener('resize', () => this.updateCardsPerView());
        },
        updateCardsPerView() {
            if (window.innerWidth >= 1024) {
                this.cardsPerView = 2;
            } else {
                this.cardsPerView = 1;
            }
        },
        startAutoPlay() {
            if (this.autoPlay && this.documentsCount > this.cardsPerView) {
                this.autoPlayInterval = setInterval(() => {
                    this.nextCards();
                }, 4000);
            }
        },
        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
        },
        nextCards() {
            const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
            this.currentIndex = this.currentIndex >= maxIndex ? 0 : this.currentIndex + 1;
        },
        previousCards() {
            const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
            this.currentIndex = this.currentIndex <= 0 ? maxIndex : this.currentIndex - 1;
        },
        goToIndex(index) {
            this.currentIndex = index;
            this.stopAutoPlay();
            this.startAutoPlay();
        }
    }"
    @mouseenter="stopAutoPlay()"
    @mouseleave="startAutoPlay()"
    class="relative {{ $height }} w-full bg-gradient-to-br from-blue-50 to-gray-100 rounded-2xl shadow-lg overflow-hidden"
>
    @if($documents->count() > 0)
        {{-- Documents Cards Container --}}
        <div class="relative h-full p-4">
            <div class="flex h-full items-center">
                <div class="w-full overflow-hidden">
                    <div 
                        class="flex transition-transform duration-500 ease-in-out h-full"
                        :style="`transform: translateX(-${currentIndex * (100 / Math.ceil(documentsCount / cardsPerView))}%)`"
                    >
                        @foreach($documents as $index => $document)
                            <div class="flex-shrink-0 w-full lg:w-1/2 px-2 h-full">
                                {{-- Document Card --}}
                                <div 
                                    class="h-full bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-[1.02] overflow-hidden"
                                    onclick="window.location.href='{{ route('documents.show', $document) }}'"
                                >
                                    {{-- Card Header --}}
                                    <div class="p-4 border-b border-gray-100">
                                        <div class="flex items-start justify-between">
                                            {{-- Document Icon --}}
                                            <div class="flex-shrink-0 p-3 bg-blue-50 rounded-lg">
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            
                                            {{-- Category Badge --}}
                                            @if($document->category)
                                                <span class="inline-block px-2 py-1 text-xs font-medium text-white rounded-full ml-2"
                                                      style="background-color: {{ $document->category->color ?? '#6366F1' }};">
                                                    {{ $document->category->name }}
                                                </span>
                                            @else
                                                <span class="inline-block px-2 py-1 text-xs font-medium text-white bg-gray-500 rounded-full ml-2">
                                                    General
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Card Body --}}
                                    <div class="p-4 flex-1 flex flex-col">
                                        {{-- Document Title --}}
                                        <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $document->title }}
                                        </h3>

                                        {{-- Document Description --}}
                                        @if($document->description)
                                            <p class="text-gray-600 text-sm mb-3 flex-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $document->description }}
                                            </p>
                                        @endif

                                        {{-- Document Info --}}
                                        <div class="flex items-center justify-between text-xs text-gray-500 pt-2 border-t border-gray-100">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ $document->getUploadedFilesCount() }} 
                                                {{ $document->getUploadedFilesCount() === 1 ? 'fișier' : 'fișiere' }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m3 0V6a2 2 0 00-2-2H5a2 2 0 00-2 2v1m16 0v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7"></path>
                                                </svg>
                                                {{ $document->created_at->format('d.m.Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Hover Effect Overlay --}}
                                    <div class="absolute inset-0 bg-blue-600 bg-opacity-0 hover:bg-opacity-5 transition-all duration-300 rounded-xl"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation Arrows --}}
        @if($documents->count() > 2)
            <button 
                @click="previousCards()"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110 z-10"
            >
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button 
                @click="nextCards()"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110 z-10"
            >
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        {{-- Dots Indicator --}}
        @if($documents->count() > 2)
            <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-1">
                @for($i = 0; $i < ceil($documents->count() / 2); $i++)
                    <button 
                        @click="goToIndex({{ $i }})"
                        class="w-2 h-2 rounded-full transition-all duration-200"
                        :class="currentIndex === {{ $i }} ? 'bg-blue-600 w-4' : 'bg-white bg-opacity-60 hover:bg-opacity-80'"
                    ></button>
                @endfor
            </div>
        @endif

        {{-- AutoPlay Toggle --}}
        <button 
            @click="$wire.toggleAutoPlay()"
            class="absolute top-3 right-3 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-200 z-10"
            :class="autoPlay ? 'text-green-600' : 'text-gray-400'"
        >
            <svg x-show="autoPlay" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6l5-3z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
            </svg>
            <svg x-show="!autoPlay" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>

        {{-- Documents Counter --}}
        <div class="absolute top-3 left-3 bg-white bg-opacity-90 rounded-full px-3 py-1 text-xs font-medium text-gray-700">
            {{ $documents->count() }} documente
        </div>

    @else
        {{-- No Documents Message --}}
        <div class="flex flex-col items-center justify-center h-full text-gray-500">
            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-lg font-medium">Nu există documente disponibile</p>
            <p class="text-sm">Documentele vor apărea aici când vor fi adăugate.</p>
        </div>
    @endif
</div>
