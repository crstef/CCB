<div>
    <!-- Main Carousel Container -->
    <div 
        x-data="{ 
            currentIndex: 0,
            documentsCount: {{ $documents->count() }},
            cardsPerView: 2
        }"
        class="relative {{ $height }} w-full bg-gradient-to-br from-blue-50 to-gray-100 rounded-2xl shadow-lg overflow-hidden">
        
        <div class="p-4">
            <h2 class="text-lg font-bold text-gray-900">Documente Recente</h2>
            <p class="text-sm text-gray-600">{{ $documents->count() }} documente disponibile</p>
        </div>
    </div>
</div>
