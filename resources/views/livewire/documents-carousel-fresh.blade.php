<div>
    <div 
        x-data="{ 
            currentIndex: 0,
            autoPlay: true,
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
        <div class="absolute top-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-b border-gray-200 p-4 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Documente Recente</h2>
                    <p class="text-sm text-gray-600">{{ $documents->count() }} documente disponibile</p>
                </div>
                
                @if($documents->count() > 2)
                    <div class="flex gap-2">
                        <button @click="previousCards()" 
                                class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextCards()" 
                                class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-20 pb-4 px-4 h-full">
            <div class="overflow-hidden h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full"
                     :style="`transform: translateX(-${currentIndex * (100 / cardsPerView)}%)`">
                    
                    @foreach($documents as $document)
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-3 h-full flex flex-col group cursor-pointer border border-gray-100 hover:border-blue-200"
                                 onclick="window.location='{{ route('documents.show', $document->id) }}'">
                                
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

                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200 text-sm">
                                    {{ $document->title }}
                                </h3>

                                @if($document->description)
                                    <p class="text-xs text-gray-600 mb-2 line-clamp-2 flex-grow">
                                        {{ $document->description }}
                                    </p>
                                @endif

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
                </div>
            </div>
        </div>

        @if($documents->count() > 2)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                @for($i = 0; $i < max(1, $documents->count() - 1); $i++)
                    <button @click="goToIndex({{ $i }})" 
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
</div>