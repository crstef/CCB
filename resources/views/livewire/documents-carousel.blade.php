<?php
<div class="bg-white rounded-2xl shadow-lg {{ $height }} overflow-hidden">
    @if($documents && $documents->count() > 0)
        <!-- Header -->
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Documente CCB</h3>
            <span class="text-sm text-gray-500">{{ $currentIndex + 1 }}/{{ $documents->count() }}</span>
        </div>

        <!-- Content -->
        @php $document = $documents[$currentIndex] @endphp
        <div class="p-6 h-full flex flex-col">
            <div class="flex items-start space-x-4 mb-4">
                <div class="w-16 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                    </svg>
                </div>
                
                <div class="flex-1 min-w-0">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $document->title }}</h4>
                    @if($document->description)
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($document->description, 150) }}</p>
                    @endif
                    @if($document->category)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $document->category->name }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Files List -->
            @if($document->getUploadedFiles())
                <div class="space-y-2 flex-1 overflow-y-auto">
                    @foreach($document->getUploadedFiles() as $file)
                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-700 truncate">{{ $file['original_name'] }}</span>
                            <div class="flex space-x-1">
                                <a href="{{ $file['url'] }}" target="_blank" 
                                   class="p-1 text-blue-600 hover:bg-blue-100 rounded" title="Vezi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </a>
                                <a href="{{ $file['url'] }}" download="{{ $file['original_name'] }}"
                                   class="p-1 text-green-600 hover:bg-green-100 rounded" title="Descarcă">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Navigation -->
        @if($documents->count() > 1)
            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                <button wire:click="previousDocument" 
                        class="p-2 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full shadow-lg">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <div class="flex space-x-2">
                    @foreach($documents as $index => $doc)
                        <button wire:click="goToDocument({{ $index }})" 
                                class="w-2 h-2 rounded-full {{ $index === $currentIndex ? 'bg-blue-600' : 'bg-white bg-opacity-50' }}">
                        </button>
                    @endforeach
                </div>

                <button wire:click="nextDocument" 
                        class="p-2 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full shadow-lg">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        @endif
    @else
        <div class="flex items-center justify-center h-full">
            <p class="text-gray-500">Nu există documente active momentan.</p>
        </div>
    @endif
</div>
