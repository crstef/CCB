<div>
    <!-- Main Carousel Container -->
    <div 
        x-data="{ 
            currentIndex: 0,
            documentsCount: {{ $documents->count() }},
            cardsPerView: 2
        }"
        class="relative {{ $height }} w-full bg-gradient-to-br from-blue-50 to-gray-100 rounded-2xl shadow-lg overflow-hidden">
        
        <!-- Header -->
        <div class="absolute top-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-b border-gray-200 p-4 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Documente Recente</h2>
                    <p class="text-sm text-gray-600">{{ $documents->count() }} documente disponibile</p>
                </div>
            </div>
        </div>

        <!-- Documents Container -->
        <div class="pt-20 pb-4 px-4 h-full">
            <div class="overflow-hidden h-full">
                <div class="flex h-full">
                    @foreach($documents as $document)
                        @php
                            $fileUrls = $document->getFileUrls();
                            $firstFile = $fileUrls[0] ?? null;
                            $extension = $firstFile ? $firstFile['type'] : null;
                            $iconClass = $document->getFileIconClass(0);
                        @endphp
                        
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-4 h-full flex flex-col">
                                <!-- Document Title -->
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $document->title }}</h3>
                                
                                <!-- Primary File Info -->
                                @if($firstFile)
                                    <div class="flex items-center p-2 bg-gray-50 rounded text-xs">
                                        <span class="inline-block w-6 h-4 text-center text-xs font-bold bg-white rounded mr-2 leading-4 {{ $iconClass }}">
                                            {{ strtoupper($extension) ?: 'DOC' }}
                                        </span>
                                        <span class="truncate font-medium">{{ $firstFile['original_name'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
