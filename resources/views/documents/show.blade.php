<x-layouts.marketing>

<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="mb-8">
            <a href="{{ route('documents.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 group">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Înapoi la Documente
            </a>
        </div>

        {{-- Document Header Card --}}
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 px-8 py-12">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
                    <div class="flex-1">
                        {{-- Category and Date --}}
                        <div class="flex items-center gap-4 mb-6">
                            @if($document->category)
                                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-full"
                                      style="background-color: {{ $document->category->color ?? '#3B82F6' }}">
                                    {{ $document->category->name }}
                                </span>
                            @endif
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $document->created_at->format('d.m.Y') }}
                            </div>
                        </div>
                        
                        {{-- Document Title --}}
                        <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $document->title }}</h1>
                        
                        {{-- Document Description --}}
                        @if($document->description)
                            <p class="text-lg text-gray-700 leading-relaxed">{{ $document->description }}</p>
                        @endif
                    </div>
                    
                    {{-- Document Icon --}}
                    <div class="mt-8 lg:mt-0 lg:ml-8">
                        <div class="p-6 bg-white rounded-2xl shadow-lg">
                            @php
                                $fileUrls = $document->getFileUrls();
                                $firstFile = $fileUrls[0] ?? null;
                                $extension = $firstFile ? strtolower($firstFile['type']) : '';
                                $iconClass = $document->getFileIconClass(0);
                            @endphp
                            <div class="relative">
                                <svg class="w-16 h-16 {{ $iconClass }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                                @if($extension)
                                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-xs font-bold uppercase">{{ $extension }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Document Stats --}}
            <div class="px-8 py-6 bg-white border-t border-gray-100">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <div class="text-3xl font-bold text-blue-600 mb-1">{{ count($fileUrls) }}</div>
                        <div class="text-sm text-gray-600 font-medium">
                            {{ count($fileUrls) === 1 ? 'Fișier' : 'Fișiere' }} Atașat{{ count($fileUrls) === 1 ? '' : 'e' }}
                        </div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-xl">
                        <div class="text-3xl font-bold text-green-600 mb-1">
                            @if($fileUrls)
                                {{ collect($fileUrls)->sum(function($file) { return $file['size'] ?? 0; }) > 0 ? 
                                   (new \App\Models\Document)->formatFileSize(collect($fileUrls)->sum(function($file) { return $file['size'] ?? 0; })) : 
                                   'N/A' }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="text-sm text-gray-600 font-medium">Mărime Totală</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-xl">
                        <div class="text-3xl font-bold text-purple-600 mb-1">
                            {{ $document->is_active ? 'Activ' : 'Inactiv' }}
                        </div>
                        <div class="text-sm text-gray-600 font-medium">Status Document</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Files Section --}}
        @if(count($fileUrls) > 0)
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Fișiere Atașate</h2>
                    <p class="text-gray-600 mt-2">Descarcă sau vizualizează fișierele documentului</p>
                </div>
                
                <div class="p-8">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($fileUrls as $index => $file)
                            <div class="group bg-gray-50 rounded-2xl p-6 hover:bg-gray-100 transition-all duration-300 hover:shadow-md border border-gray-200">
                                {{-- File Header --}}
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-white rounded-xl shadow-sm">
                                            <svg class="w-6 h-6 {{ $document->getFileIconClass($index) }}" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-xs font-medium text-gray-500">Fișier {{ $index + 1 }}</div>
                                            <div class="text-sm font-bold text-gray-900 uppercase">{{ strtoupper($file['type']) ?: 'DOC' }}</div>
                                        </div>
                                    </div>
                                    @if($file['size_formatted'])
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">{{ $file['size_formatted'] }}</span>
                                    @endif
                                </div>
                                
                                {{-- File Name --}}
                                <h3 class="font-semibold text-gray-900 mb-3 break-words">{{ $file['original_name'] }}</h3>
                                
                                {{-- File Actions --}}
                                <div class="space-y-2">
                                    @if(strtolower($file['type']) === 'pdf')
                                        <button onclick="viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')"
                                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center justify-center group">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Vizualizează PDF
                                        </button>
                                    @endif
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ $file['url'] }}" 
                                           target="_blank"
                                           class="flex-1 bg-gray-600 text-white text-center py-3 px-4 rounded-xl hover:bg-gray-700 transition-colors duration-200 font-medium flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Deschide
                                        </a>
                                        <a href="{{ $file['url'] }}" 
                                           download="{{ $file['original_name'] }}"
                                           class="flex-1 bg-green-600 text-white text-center py-3 px-4 rounded-xl hover:bg-green-700 transition-colors duration-200 font-medium flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Descarcă
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            {{-- No Files Message --}}
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <div class="p-12 text-center">
                    <div class="p-6 bg-gray-100 rounded-full inline-block mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Nu sunt fișiere atașate</h3>
                    <p class="text-gray-600">Acest document nu are încă fișiere atașate.</p>
                </div>
            </div>
        @endif

        {{-- Related Documents --}}
        @if($document->category)
            @php
                $relatedDocuments = \App\Models\Document::where('document_category_id', $document->category->id)
                    ->where('id', '!=', $document->id)
                    ->where('is_active', true)
                    ->limit(3)
                    ->get();
            @endphp
            
            @if($relatedDocuments->count() > 0)
                <div class="mt-12 bg-white rounded-3xl shadow-lg overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900">Documente Similare</h2>
                        <p class="text-gray-600 mt-2">Alte documente din categoria "{{ $document->category->name }}"</p>
                    </div>
                    
                    <div class="p-8">
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($relatedDocuments as $relatedDoc)
                                @php
                                    $relatedFileUrls = $relatedDoc->getFileUrls();
                                    $relatedFirstFile = $relatedFileUrls[0] ?? null;
                                    $relatedExtension = $relatedFirstFile ? strtolower($relatedFirstFile['type']) : '';
                                    $relatedIconClass = $relatedDoc->getFileIconClass(0);
                                @endphp
                                <a href="{{ route('documents.show', $relatedDoc) }}" 
                                   class="group block bg-gray-50 rounded-2xl p-6 hover:bg-gray-100 transition-all duration-300 hover:shadow-md border border-gray-200">
                                    <div class="flex items-center mb-4">
                                        <div class="p-3 bg-white rounded-xl shadow-sm">
                                            <svg class="w-6 h-6 {{ $relatedIconClass }}" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-xs font-medium text-gray-500">{{ count($relatedFileUrls) }} fișier{{ count($relatedFileUrls) > 1 ? 'e' : '' }}</div>
                                            <div class="text-sm font-bold text-gray-900 uppercase">{{ strtoupper($relatedExtension) ?: 'DOC' }}</div>
                                        </div>
                                    </div>
                                    
                                    <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                        {{ $relatedDoc->title }}
                                    </h3>
                                    
                                    @if($relatedDoc->description)
                                        <p class="text-sm text-gray-600 line-clamp-2">{{ $relatedDoc->description }}</p>
                                    @endif
                                    
                                    <div class="mt-3 text-xs text-gray-500">
                                        {{ $relatedDoc->created_at->format('d.m.Y') }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<!-- PDF Viewer Modal -->
<div id="documentModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-7xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Document</h3>
                <button onclick="closeDocumentModal()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal Content -->
            <div id="modalContent" class="overflow-hidden" style="height: calc(90vh - 80px);">
                <!-- Content will be inserted here -->
            </div>
        </div>
    </div>
</div>

<script>
// Document viewer
function viewDocument(url, name, type) {
    const modal = document.getElementById('documentModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    
    modalTitle.textContent = name;
    
    const extension = type.toLowerCase();
    
    if (extension === 'pdf') {
        // PDF documents - direct iframe
        modalContent.innerHTML = `
            <iframe src="${url}" 
                    class="w-full h-full border-0" 
                    title="${name}">
                <p>Browser-ul dumneavoastră nu suportă vizualizarea PDF-urilor. <a href="${url}" target="_blank">Deschideți în tab nou</a></p>
            </iframe>
        `;
    } else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(extension)) {
        // Microsoft Office documents - using Office Online viewer
        const officeViewerUrl = `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(window.location.origin + url)}`;
        modalContent.innerHTML = `
            <iframe src="${officeViewerUrl}" 
                    class="w-full h-full border-0" 
                    title="${name}">
                <p>Nu se poate încărca previzualizarea. <a href="${url}" target="_blank">Deschideți în tab nou</a></p>
            </iframe>
        `;
    } else if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extension)) {
        // Images - direct display
        modalContent.innerHTML = `
            <div class="flex items-center justify-center h-full p-4">
                <img src="${url}" alt="${name}" class="max-w-full max-h-full object-contain">
            </div>
        `;
    } else if (extension === 'txt') {
        // Text files - fetch and display content
        fetch(url)
            .then(response => response.text())
            .then(text => {
                modalContent.innerHTML = `
                    <div class="p-6 h-full overflow-auto">
                        <pre class="whitespace-pre-wrap text-sm font-mono">${text}</pre>
                    </div>
                `;
            })
            .catch(() => {
                modalContent.innerHTML = `
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center">
                            <p class="text-lg font-medium text-gray-900 mb-2">Nu se poate încărca fișierul</p>
                            <a href="${url}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Deschide în tab nou
                            </a>
                        </div>
                    </div>
                `;
            });
        return; // Exit early since we're using fetch
    } else {
        // Other file types - fallback message
        modalContent.innerHTML = `
            <div class="flex items-center justify-center h-full">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-medium text-gray-900 mb-2">Previzualizare indisponibilă</p>
                    <p class="text-gray-600 mb-4">Acest tip de fișier nu poate fi previzualizat în browser.</p>
                    <a href="${url}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Deschide în tab nou
                    </a>
                </div>
            </div>
        `;
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDocumentModal() {
    const modal = document.getElementById('documentModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDocumentModal();
    }
});

// Close modal when clicking outside
document.getElementById('documentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDocumentModal();
    }
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

</x-layouts.marketing>
