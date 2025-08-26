<div>
    <div 
        x-data="{ 
            currentIndex: 0,
            documentsCount: {{ $documents->count() }},
            cardsPerView: 2,
            nextSlide() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                this.currentIndex = this.currentIndex >= maxIndex ? 0 : this.currentIndex + 1;
            },
            prevSlide() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                this.currentIndex = this.currentIndex <= 0 ? maxIndex : this.currentIndex - 1;
            }
        }"
        class="relative h-[400px] bg-gray-50 rounded-lg overflow-hidden">
        
        <!-- Header -->
        <div class="p-4 bg-white border-b">
            <h2 class="text-lg font-bold">Documente Recente</h2>
            <p class="text-sm text-gray-600">{{ $documents->count() }} documente</p>
            
            <!-- Navigation -->
            @if($documents->count() > 2)
                <div class="flex gap-2 mt-2">
                    <button @click="prevSlide()" class="px-3 py-1 bg-blue-500 text-white rounded">←</button>
                    <button @click="nextSlide()" class="px-3 py-1 bg-blue-500 text-white rounded">→</button>
                </div>
            @endif
        </div>
        
        <!-- Carousel Container -->
        <div class="p-4 h-full overflow-hidden">
            <div class="flex transition-transform duration-500 h-full"
                 :style="`transform: translateX(-${currentIndex * (100 / cardsPerView)}%)`">
                
                @foreach($documents as $document)
                    <div class="w-1/2 flex-shrink-0 px-2 h-full">
                        <div class="bg-white rounded-lg shadow p-4 h-full">
                            <h3 class="font-semibold mb-2">{{ $document->title }}</h3>
                            <p class="text-xs text-gray-500">{{ $document->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
