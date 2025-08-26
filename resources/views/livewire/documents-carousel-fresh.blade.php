<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Documente recente</h2>
        
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
                if (this.currentIndex >= maxIndex) {
                    this.currentIndex = 0;
                } else {
                    this.currentIndex++;
                }
            },
            previousCards() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                if (this.currentIndex <= 0) {
                    this.currentIndex = maxIndex;
                } else {
                    this.currentIndex--;
                }
            },
            goToIndex(index) {
                this.currentIndex = index;
                this.stopAutoPlay();
                this.startAutoPlay();
            }
        }"
        @mouseenter="stopAutoPlay()"
        @mouseleave="startAutoPlay()"
        class="bg-white rounded-2xl shadow-lg overflow-hidden relative"
        style="height: 280px;"
    >
        <div class="overflow-hidden h-full px-6 pt-6 pb-4">
            <div class="flex transition-transform duration-500 ease-in-out h-full" 
                 :style="`transform: translateX(-${currentIndex * (100 / cardsPerView)}%); width: ${(documentsCount / cardsPerView) * 100}%`">
                @foreach($documents as $document)
                    <a href="{{ route('documents.show', $document) }}" 
                       class="flex-shrink-0 px-3 h-full flex flex-col"
                       style="width: {{ 100 / $documents->count() }}%">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 h-full flex flex-col border border-blue-200 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 text-sm line-clamp-2">{{ $document->title }}</h3>
                                    <p class="text-xs text-gray-600 mt-1">{{ $document->category->name ?? 'Necategorizat' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex-1 flex flex-col justify-between">
                                <p class="text-gray-700 text-sm line-clamp-3 mb-4">{{ Str::limit($document->description, 100) }}</p>
                                
                                <div class="flex items-center justify-between mt-auto">
                                    <span class="text-xs text-gray-500">
                                        {{ $document->created_at->format('d.m.Y') }}
                                    </span>
                                    @if($document->files && count($document->files) > 0)
                                        @php
                                            $firstFile = $document->files[0];
                                            $fileName = is_array($firstFile) ? ($firstFile['name'] ?? $firstFile['path']) : $firstFile;
                                            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ strtoupper($extension) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        
        @if($documents->count() > 2)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @php
                    $totalPages = max(1, ceil($documents->count() / 2));
                @endphp
                @for($i = 0; $i < $totalPages; $i++)
                    <button @click="goToIndex({{ $i }})" 
                            :class="currentIndex === {{ $i }} ? 'bg-blue-600' : 'bg-gray-300'"
                            class="w-2 h-2 rounded-full transition-colors duration-200">
                    </button>
                @endfor
            </div>
        @endif
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
