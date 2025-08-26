<x-layouts.marketing>

<div class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('documents.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Înapoi la Documente
            </a>
        </div>

        {{-- Document Header --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                {{-- Document Title and Category --}}
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-6">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $document->title }}</h1>
                        
                        @if($document->category)
                            <span class="inline-block px-4 py-2 text-sm font-medium text-white rounded-full"
                                  style="background-color: {{ $document->category->color ?? '#3B82F6' }}">
                                {{ $document->category->name }}
                            </span>
                        @endif
                    </div>
                    
                    {{-- Document Icon --}}
                    <div class="mt-4 sm:mt-0 sm:ml-6">
                        <div class="p-4 bg-blue-50 rounded-xl">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Document Info --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 p-6 bg-gray-50 rounded-xl">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $document->getUploadedFilesCount() }}</div>
                        <div class="text-sm text-gray-600">
                            {{ $document->getUploadedFilesCount() === 1 ? 'Fișier' : 'Fișiere' }}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $document->created_at->format('d.m.Y') }}</div>
                        <div class="text-sm text-gray-600">Data Creării</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">
                            {{ $document->is_active ? 'Activ' : 'Inactiv' }}
                        </div>
                        <div class="text-sm text-gray-600">Status</div>
                    </div>
                </div>

                {{-- Document Description --}}
                @if($document->description)
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Descriere</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($document->description)) !!}
                        </div>
                    </div>
                @endif

                {{-- Document Files --}}
                @if($document->files && count($document->files) > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Fișiere Atașate</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($document->files as $index => $file)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 bg-blue-50 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-medium text-gray-900">Fișier {{ $index + 1 }}</h3>
                                            <p class="text-sm text-gray-500">{{ basename($file) }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <a href="{{ $document->getFileUrl($index) }}" 
                                           target="_blank"
                                           class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium">
                                            Vezi Fișier
                                        </a>
                                        <a href="{{ $document->getFileUrl($index) }}" 
                                           download
                                           class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-200 text-sm font-medium">
                                            Descarcă
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('documents.index') }}" 
                       class="flex-1 bg-gray-600 text-white text-center py-3 px-6 rounded-lg hover:bg-gray-700 transition-colors duration-200 font-medium">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Toate Documentele
                    </a>
                    
                    @if($document->files && count($document->files) > 0)
                        <a href="{{ $document->getFileUrl(0) }}" 
                           target="_blank"
                           class="flex-1 bg-blue-600 text-white text-center py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Vezi Primul Fișier
                        </a>
                        
                        <a href="{{ $document->getFileUrl(0) }}" 
                           download
                           class="flex-1 bg-green-600 text-white text-center py-3 px-6 rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Descarcă Primul Fișier
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Related Documents --}}
        @if($document->category)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Documente din aceeași categorie</h2>
                
                @php
                    $relatedDocuments = App\Models\Document::where('document_category_id', $document->category->id)
                        ->where('id', '!=', $document->id)
                        ->active()
                        ->latest()
                        ->take(3)
                        ->get();
                @endphp
                
                @if($relatedDocuments->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedDocuments as $relatedDoc)
                            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                                <div class="p-6">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $relatedDoc->title }}</h3>
                                    @if($relatedDoc->description)
                                        <p class="text-gray-600 text-sm mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $relatedDoc->description }}
                                        </p>
                                    @endif
                                    <a href="{{ route('documents.show', $relatedDoc) }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 font-medium">
                                        Vezi Document
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">Nu există alte documente în această categorie.</p>
                @endif
            </div>
        @endif
    </div>
</div>

</x-layouts.marketing>
