<div 
    x-data="{ 
        currentIndex: @entangle('currentIndex'),
        autoPlay: @entangle('autoPlay'),
        autoPlayInterval: null,
        documentsCount: {{ $documents->count() }},
        init() {
            this.startAutoPlay();
        },
        startAutoPlay() {
            if (this.autoPlay && this.documentsCount > 1) {
                this.autoPlayInterval = setInterval(() => {
                    this.nextDocument();
                }, 5000);
            }
        },
        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
        },
        nextDocument() {
            @this.nextDocument();
        },
        previousDocument() {
            @this.previousDocument();
        },
        goToDocument(index) {
            @this.goToDocument(index);
            this.stopAutoPlay();
            this.startAutoPlay();
        }
    }"
    @mouseenter="stopAutoPlay()"
    @mouseleave="startAutoPlay()"
    class="relative {{ $height }} w-full bg-gradient-to-br from-blue-50 to-gray-100 rounded-2xl shadow-lg overflow-hidden"
>
    @if($documents->count() > 0)
        {{-- Documents Display --}}
        <div class="relative h-full flex items-center justify-center p-6">
            @foreach($documents as $index => $document)
                <div 
                    x-show="currentIndex === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform -translate-x-8"
                    class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center"
                >
                    {{-- Document Icon --}}
                    <div class="mb-4 p-4 bg-white rounded-full shadow-md">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>

                    {{-- Document Title --}}
                    <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                        {{ $document->title }}
                    </h3>

                    {{-- Category Badge --}}
                    @if($document->category)
                        <span class="inline-block px-3 py-1 mb-3 text-sm font-medium text-white rounded-full"
                              style="background-color: {{ $document->category->color ?? '#3B82F6' }}">
                            {{ $document->category->name }}
                        </span>
                    @endif

                    {{-- Document Description --}}
                    @if($document->description)
                        <p class="text-gray-600 mb-4 line-clamp-3 max-w-md">
                            {{ $document->description }}
                        </p>
                    @endif

                    {{-- Document Info --}}
                    <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            {{ $document->getUploadedFilesCount() }} 
                            {{ $document->getUploadedFilesCount() === 1 ? 'fișier' : 'fișiere' }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m3 0V6a2 2 0 00-2-2H5a2 2 0 00-2 2v1m16 0v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7"></path>
                            </svg>
                            {{ $document->created_at->format('d.m.Y') }}
                        </span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex space-x-3">
                        <a href="{{ route('documents.index') }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>Vezi Document</span>
                        </a>
                        
                        @if($document->files && count($document->files) > 0)
                            <a href="{{ $document->getFileUrl(0) }}" 
                               target="_blank"
                               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Descarcă</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Navigation Arrows --}}
        @if($documents->count() > 1)
            <button 
                @click="previousDocument()"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110"
            >
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button 
                @click="nextDocument()"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110"
            >
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        {{-- Dots Indicator --}}
        @if($documents->count() > 1)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach($documents as $index => $document)
                    <button 
                        @click="goToDocument({{ $index }})"
                        class="w-2 h-2 rounded-full transition-all duration-200"
                        :class="currentIndex === {{ $index }} ? 'bg-blue-600 w-6' : 'bg-white bg-opacity-60 hover:bg-opacity-80'"
                    ></button>
                @endforeach
            </div>
        @endif

        {{-- AutoPlay Toggle --}}
        <button 
            @click="$wire.toggleAutoPlay()"
            class="absolute top-4 right-4 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-200"
            :class="autoPlay ? 'text-green-600' : 'text-gray-400'"
        >
            <svg x-show="autoPlay" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6l5-3z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
            </svg>
            <svg x-show="!autoPlay" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>

        {{-- Document Counter --}}
        <div class="absolute top-4 left-4 bg-white bg-opacity-90 rounded-full px-3 py-1 text-sm font-medium text-gray-700">
            <span x-text="currentIndex + 1"></span> / {{ $documents->count() }}
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
