{{-- Include custom gallery button styles --}}
<link rel="stylesheet" href="{{ asset('css/gallery-buttons.css') }}">
<style>
/* High Priority Gallery Button Overrides */
a.gallery-button,
a.gallery-button:link,
a.gallery-button:visited {
    background-color: rgba(107, 114, 128, 0.85) !important;
    background: rgba(107, 114, 128, 0.85) !important;
    border: 2px solid rgba(107, 114, 128, 0.85) !important;
    border-radius: 0.75rem !important;
    padding: 0.75rem 1.5rem !important;
    position: relative !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 50px !important;
    color: #ffffff !important;
    backdrop-filter: blur(8px) !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
}

a.gallery-button::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: -100% !important;
    width: 100% !important;
    height: 100% !important;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent) !important;
    transition: left 0.5s ease !important;
}

a.gallery-button:hover::before {
    left: 100% !important;
}

a.gallery-button:hover,
a.gallery-button:focus,
a.gallery-button:active {
    background-color: rgba(0, 0, 0, 0.9) !important;
    background: rgba(0, 0, 0, 0.9) !important;
    border-color: rgba(0, 0, 0, 0.9) !important;
    transform: scale(1.02) translateY(-1px) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
    color: #ffffff !important;
    text-decoration: none !important;
}

a.gallery-button .gallery-button-inner {
    background-color: transparent !important;
    background: transparent !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    display: flex !important;
    align-items: center !important;
    width: 100% !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
}

a.gallery-button:hover .gallery-button-inner {
    background-color: transparent !important;
    background: transparent !important;
}

a.gallery-button .gallery-button-text {
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 0.95rem !important;
    margin-left: 0.5rem !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

a.gallery-button .gallery-button-icon {
    color: #ffffff !important;
    width: 1.25rem !important;
    height: 1.25rem !important;
    transition: transform 0.3s ease !important;
    filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.3)) !important;
}

a.gallery-button:hover .gallery-button-icon {
    transform: rotate(8deg) scale(1.05) !important;
    color: #ffffff !important;
}
</style>

<section class="relative top-0 flex flex-col items-center justify-center w-full min-h-screen -mt-24 bg-white lg:min-h-screen">
    
    <div class="flex flex-col items-center justify-between flex-1 w-full max-w-2xl gap-2 px-8 pt-32 mx-auto text-left md:px-12 xl:px-20 lg:pt-32 lg:pb-4 lg:max-w-7xl lg:flex-row">
        
        {{-- Left Column: Media Carousel from organized media components --}}
        <div class="w-full lg:w-1/2">
            <div class="w-full mb-2 lg:mb-0 max-w-2xl mx-auto lg:mx-0">
                {{-- Premium Media Carousel with database-driven content from Gallery category --}}
                <div class="bg-white rounded-2xl shadow-lg h-[400px] lg:h-[450px] overflow-hidden">
                    @livewire('media-carousel', ['height' => 'h-full'])
                </div>
                
                {{-- Premium Gallery Navigation Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 mt-6 justify-center">
                    {{-- Photo Gallery Button --}}
                    <a href="{{ route('galerie-foto') }}" class="gallery-button">
                        <div class="gallery-button-inner">
                            <svg class="gallery-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="gallery-button-text">Galerie Foto</span>
                        </div>
                    </a>
                    
                    {{-- Video Gallery Button --}}
                    <a href="{{ route('galerie-video') }}" class="gallery-button">
                        <div class="gallery-button-inner">
                            <svg class="gallery-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="gallery-button-text">Galerie Video</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Documents Carousel --}}
        <div class="w-full lg:w-1/2">
            <div class="w-full mt-4 lg:mt-0 max-w-2xl mx-auto lg:mx-0">
                {{-- Premium Documents Carousel with latest documents --}}
                @livewire('documents-carousel', ['height' => 'h-[400px] lg:h-[450px]']) 
                {{-- Premium Documents Navigation Button --}}
                <div class="flex justify-center mt-6">
                    <a href="{{ route('documents.index') }}" class="gallery-button">
                        <div class="gallery-button-inner">
                            <svg class="gallery-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="gallery-button-text">Toate Documentele</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Original Wave 3.0 Bottom Section --}}
    <div class="flex-shrink-0 lg:h-[150px] flex border-t border-zinc-200 items-center w-full bg-white mt-2 lg:mt-0">
        <div class="grid h-auto grid-cols-1 px-8 py-8 mx-auto space-y-5 divide-y max-w-7xl lg:space-y-0 lg:divide-y-0 divide-zinc-200 lg:py-0 lg:divide-x md:px-12 lg:px-20 lg:divide-zinc-200 lg:grid-cols-3">
            <div class="">
                <h3 class="flex items-center font-medium text-zinc-900">
                    Cum devii membru
                </h3>
                <p class="mt-2 text-sm font-medium text-zinc-500">
                    Modalitatea și beneficiile de a deveni membru. <span class="hidden lg:inline">Mai multe explicații</span>
                </p>
            </div>
            <div class="pt-5 lg:pt-0 lg:px-10">
                <h3 class="font-medium text-zinc-900">Misiunea Clubului</h3>
                <p class="mt-2 text-sm text-zinc-500">
                    Ce ne propunem să realizăm. <span class="hidden lg:inline">Explică aici.</span>
                </p>
            </div>
            <div class="pt-5 lg:pt-0 lg:px-10">
                <h3 class="font-medium text-zinc-900">Calendar Competițional</h3>
                <p class="mt-2 text-sm text-zinc-500">
                    Calendarul competițional pe anul în curs.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Document Modal (copied from documents/index.blade.php) -->
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
// Document modal functions (copied from documents/index.blade.php)
function viewDocument(url, name, type) {
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
    }, 100);
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
document.addEventListener('click', function(e) {
    const modal = document.getElementById('documentModal');
    if (e.target === modal) {
        closeDocumentModal();
    }
});

// Make functions globally available
window.viewDocument = viewDocument;
window.closeDocumentModal = closeDocumentModal;
</script>