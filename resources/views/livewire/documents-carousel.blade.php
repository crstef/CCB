<div>
    <div class="bg-white rounded-2xl shadow-lg {{ $height }} overflow-hidden relative">
        @if($documents && $documents->count() > 0)
            <!-- Header -->
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Documente CCB</h3>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ $currentIndex + 1 }}/{{ $documents->count() }}</span>
                    <!-- Navigation in Header -->
                    @if($documents->count() > 1)
                        <div class="flex items-center space-x-2">
                            <button wire:click="previousDocument" 
                                    class="p-1.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <div class="flex space-x-1">
                                @foreach($documents as $index => $doc)
                                    <button wire:click="goToDocument({{ $index }})" 
                                            class="w-1.5 h-1.5 rounded-full transition-all duration-200 {{ $index === $currentIndex ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400' }}">
                                    </button>
                                @endforeach
                            </div>
                            <button wire:click="nextDocument" 
                                    class="p-1.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Content -->
            @php $document = $documents[$currentIndex] @endphp
            <div class="p-6 h-full flex flex-col">
                <div class="flex items-start space-x-4 mb-4">
                    <!-- Document Icon -->
                    <div class="w-12 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white flex-shrink-0 relative">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                        @php
                            $firstFile = $document->getUploadedFiles()[0] ?? null;
                            $extension = $firstFile ? strtolower($firstFile['type']) : '';
                        @endphp
                        @if($extension)
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-white rounded-full flex items-center justify-center text-xs font-bold text-gray-700 shadow-sm">
                                {{ strtoupper(substr($extension, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Document Info -->
                    <div class="flex-1 min-w-0">
                        <h4 class="text-base font-semibold text-gray-900 mb-2">{{ $document->title }}</h4>
                        @if($document->description)
                            <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ $document->description }}</p>
                        @endif
                        <div class="flex items-center space-x-3">
                            @if($document->category)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $document->category->name }}
                                </span>
                            @endif
                            <span class="text-xs text-gray-500">
                                {{ $document->getUploadedFilesCount() }} 
                                {{ $document->getUploadedFilesCount() == 1 ? 'fișier' : 'fișiere' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Files List -->
                @if($document->getUploadedFiles())
                    <div class="space-y-2 flex-1 overflow-y-auto max-h-40">
                        @foreach($document->getUploadedFiles() as $index => $file)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center space-x-3 min-w-0 flex-1">
                                    @php
                                        $ext = strtolower($file['type']);
                                        $iconBg = match($ext) {
                                            'pdf' => 'bg-red-500',
                                            'doc', 'docx' => 'bg-blue-500',
                                            'xls', 'xlsx' => 'bg-green-500',
                                            'ppt', 'pptx' => 'bg-orange-500',
                                            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'bg-purple-500',
                                            'txt' => 'bg-gray-500',
                                            default => 'bg-blue-500'
                                        };
                                    @endphp
                                    
                                    <div class="w-10 h-10 {{ $iconBg }} rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                    </div>
                                    
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $file['original_name'] }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format(($file['size'] ?? 0) / 1024, 1) }} KB</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2 flex-shrink-0">
                                    <button onclick="viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-md transition-colors duration-200"
                                       title="Vezi {{ $file['original_name'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    
                                    <a href="{{ $file['url'] }}" 
                                       download="{{ $file['original_name'] }}"
                                       class="p-2 text-green-600 hover:bg-green-100 rounded-md transition-colors duration-200"
                                       title="Descarcă {{ $file['original_name'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="flex flex-col items-center justify-center h-full p-8 text-center">
                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Nu există documente</h3>
                <p class="text-gray-500">Nu sunt documente active pentru afișare momentan.</p>
            </div>
        @endif
    </div>

    <div id="documentModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-7xl w-full max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Document</h3>
                    <button onclick="closeDocumentModal()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="overflow-hidden" style="height: calc(90vh - 80px);"></div>
            </div>
        </div>
    </div>

    <script>
    function viewDocument(url, name, type) {
        const modal = document.getElementById('documentModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        modalTitle.textContent = name;
        
        modalContent.innerHTML = '<div class="flex items-center justify-center h-full"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div></div>';
        
        const extension = type.toLowerCase();
        
        setTimeout(() => {
            if (extension === 'pdf') {
                modalContent.innerHTML = `<iframe src="${url}" class="w-full h-full border-0"></iframe>`;
            } else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(extension)) {
                const officeViewerUrl = `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(window.location.origin + url)}`;
                modalContent.innerHTML = `<iframe src="${officeViewerUrl}" class="w-full h-full border-0"></iframe>`;
            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extension)) {
                modalContent.innerHTML = `<div class="flex items-center justify-center h-full p-4"><img src="${url}" alt="${name}" class="max-w-full max-h-full object-contain"></div>`;
            } else {
                modalContent.innerHTML = `<div class="flex items-center justify-center h-full"><div class="text-center"><p class="mb-4">Previzualizare indisponibilă</p><a href="${url}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Deschide în tab nou</a></div></div>`;
            }
        }, 100);
    }

    function closeDocumentModal() {
        document.getElementById('documentModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDocumentModal();
    });

    document.getElementById('documentModal').addEventListener('click', function(e) {
        if (e.target === this) closeDocumentModal();
    });
    </script>
</div>