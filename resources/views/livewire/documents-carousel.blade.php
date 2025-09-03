<div>
    <!-- Main Carousel Component -->
    <div class="bg-white rounded-2xl shadow-lg {{ $height }} overflow-hidden relative documents-carousel">
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
            <!-- Document Info - No header icon as requested -->
            <div class="flex-1 min-w-0 mb-4">
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

            <!-- Files List -->
            @if($document->getUploadedFiles())
                <div class="space-y-2 flex-1 overflow-y-auto max-h-40">
                    @foreach($document->getUploadedFiles() as $index => $file)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="flex items-center space-x-3 min-w-0 flex-1">
                                <!-- File Type Icon with specific colors -->
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
                                    $icon = match($ext) {
                                        'pdf' => '<path d="M8 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6.828a2 2 0 0 0-.586-1.414l-2.828-2.828A2 2 0 0 0 13.172 2H8Z"/><path d="M9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Z"/><path d="M9 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"/><path d="M9 15a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"/>',
                                        'doc', 'docx' => '<path d="M9 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V6.828a2 2 0 0 0-.586-1.414l-2.828-2.828A2 2 0 0 0 12.172 2H9Z"/><path d="M12 10H9a1 1 0 0 0 0 2h3a1 1 0 1 0 0-2Z"/><path d="M15 14H9a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z"/>',
                                        'xls', 'xlsx' => '<path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.828a2 2 0 0 0-.586-1.414l-2.828-2.828A2 2 0 0 0 15.172 2H6Z"/><path d="M8 7h8v2H8V7Z"/><path d="M8 11h8v2H8v-2Z"/><path d="M8 15h8v2H8v-2Z"/>',
                                        'ppt', 'pptx' => '<path d="M7 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6.828a2 2 0 0 0-.586-1.414l-2.828-2.828A2 2 0 0 0 14.172 2H7Z"/><circle cx="12" cy="12" r="3"/>',
                                        'jpg', 'jpeg', 'png', 'gif', 'webp' => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14,2 14,8 20,8"/><circle cx="10" cy="13" r="2"/><path d="m20 17-1.09-1.09a2 2 0 0 0-2.82 0L10 22"/>',
                                        default => '<path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>'
                                    };
                                @endphp
                                
                                <div class="w-10 h-10 {{ $iconBg }} rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        {!! $icon !!}
                                    </svg>
                                </div>
                                
                                <!-- File Info -->
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $file['original_name'] }}</p>
                                    <p class="text-xs text-gray-500">{{ number_format(($file['size'] ?? 0) / 1024, 1) }} KB</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 flex-shrink-0">
                                <!-- View Button - Opens in modal -->
                                @if($document->canViewInline($index))
                                    <button onclick="viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')"
                                            class="p-2 text-blue-600 hover:bg-blue-100 rounded-md transition-colors duration-200"
                                            title="Vezi {{ $file['original_name'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                @endif
                                
                                <!-- View Button - Opens in new tab -->
                                <a href="{{ $file['url'] }}" target="_blank"
                                   class="p-2 text-blue-600 hover:bg-blue-100 rounded-md transition-colors duration-200"
                                   title="Vezi {{ $file['original_name'] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                
                                <!-- Download Button -->
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
        <!-- No Documents State -->
        <div class="flex flex-col items-center justify-center h-full p-8 text-center">
            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Nu există documente</h3>
            <p class="text-gray-500">Nu sunt documente active pentru afișare momentan.</p>
        </div>
    @endif
    </div>

    <!-- Document Modal -->
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

    <!-- Event Listeners for Document Modal -->
    <script>
    // Add global event listeners for the document modal
    document.addEventListener('DOMContentLoaded', function() {
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.closeDocumentModal();
            }
        });

        // Close modal when clicking outside
        const documentModal = document.getElementById('documentModal');
        if (documentModal) {
            documentModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    window.closeDocumentModal();
                }
            });
        }
    });
    </script>

    <script>
    // Make viewDocument and closeDocumentModal functions globally available
window.viewDocument = function(url, name, type) {
    console.log('viewDocument called with:', {url, name, type}); // Debug
    
    const modal = document.getElementById('documentModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    
    if (!modal || !modalTitle || !modalContent) {
        console.error('Modal elements not found');
        return;
    }
    
    // Show modal first
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    modalTitle.textContent = name;
    
    // Show loading state
    modalContent.innerHTML = `
        <div class="flex items-center justify-center h-full">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Se încarcă documentul...</p>
            </div>
        </div>
    `;
    
    const extension = type.toLowerCase();
    
    // Small delay to ensure modal is visible
    setTimeout(() => {
    
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
    
    }, 100); // 100ms delay
};

window.closeDocumentModal = function() {
    const modal = document.getElementById('documentModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
};

// Auto-play functionality for carousel
document.addEventListener('livewire:init', () => {
    const autoPlayInterval = 5000; // 5 seconds
    let autoPlayTimer;
    
    function startAutoPlay() {
        if (@json($documents->count()) > 1) {
            autoPlayTimer = setInterval(() => {
                @this.nextDocument();
            }, autoPlayInterval);
        }
    }
    
    function stopAutoPlay() {
        if (autoPlayTimer) {
            clearInterval(autoPlayTimer);
        }
    }
    
    // Start autoplay when component loads
    startAutoPlay();
    
    // Pause autoplay on hover
    const carousel = document.querySelector('.documents-carousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', stopAutoPlay);
        carousel.addEventListener('mouseleave', startAutoPlay);
    }
    
    // Reset autoplay when manually navigating
    Livewire.on('documentChanged', () => {
        stopAutoPlay();
        setTimeout(startAutoPlay, 1000); // Resume after 1 second
    });
});
    </script>
</div>
