<div>
    <!-- Main Carousel Container -->
    <div 
        x-data="{ 
            currentIndex: 0,
            autoPlay: @entangle('autoPlay'),
            autoPlayInterval: null,
            documentsCount: {{ $documents->count() }},
            cardsPerView: 2,
            init() {
                this.updateCardsPerView();
                this.startAutoPlay();
                window.addEventListener('resize', () => this.updateCardsPerView());
            },
            updateCardsPerView() {
                if (window.innerWidth >= 1024) {
                    this.cardsPerView = 2;
                } else {
                    this.cardsPerView = 1;
                }
            },
            startAutoPlay() {
                if (this.autoPlay && this.documentsCount > this.cardsPerView) {
                    this.autoPlayInterval = setInterval(() => {
                        this.nextCards();
                    }, 4000);
                }
            },
            stopAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
            },
            nextCards() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                this.currentIndex = this.currentIndex >= maxIndex ? 0 : this.currentIndex + 1;
            },
            previousCards() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                this.currentIndex = this.currentIndex <= 0 ? maxIndex : this.currentIndex - 1;
            },
            goToIndex(index) {
                this.currentIndex = index;
                this.stopAutoPlay();
                this.startAutoPlay();
            }
        }"
        @mouseenter="stopAutoPlay()"
        @mouseleave="startAutoPlay()"
        class="relative {{ $height }} w-full bg-gradient-to-br from-blue-50 to-gray-100 rounded-2xl shadow-lg overflow-hidden"
    >
    @if($documents->count() > 0)
        {{-- Documents Cards Container --}}
        <div class="relative h-full p-4">
            <div class="flex h-full items-center">
                <div class="w-full overflow-hidden">
                    <div 
                        class="flex transition-transform duration-500 ease-in-out h-full"
                        :style="`transform: translateX(-${currentIndex * (100 / Math.ceil(documentsCount / cardsPerView))}%)`"
                    >
                        @foreach($documents as $index => $document)
                            <div class="flex-shrink-0 w-full lg:w-1/2 px-3 h-full">
                                {{-- Document Card --}}
                                <div 
                                    class="h-full bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:scale-[1.02] overflow-hidden border border-gray-100 group"
                                    onclick="window.location.href='{{ route('documents.show', $document) }}'"
                                >
                                    {{-- Document Icon Header --}}
                                    <div class="relative h-20 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center group-hover:from-blue-50 group-hover:to-indigo-100 transition-all duration-300">
                                        @php
                                            $fileUrls = $document->getFileUrls();
                                            $firstFile = $fileUrls[0] ?? null;
                                            $extension = $firstFile ? strtolower($firstFile['type']) : '';
                                            $iconClass = $document->getFileIconClass(0);
                                        @endphp
                                        <div class="relative">
                                            <svg class="w-10 h-10 {{ $iconClass }} group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                            </svg>
                                            @if($extension)
                                                <div class="absolute -top-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100">
                                                    <span class="text-xs font-bold uppercase text-gray-600">{{ $extension }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Document Content --}}
                                    <div class="p-4 flex-1 flex flex-col">
                                        <div class="flex items-start justify-between mb-2">
                                            @if($document->category)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white" 
                                                      style="background-color: {{ $document->category->color ?? '#6B7280' }}">
                                                    {{ $document->category->name }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white bg-gray-500">
                                                    General
                                                </span>
                                            @endif
                                            <time class="text-xs text-gray-500" datetime="{{ $document->created_at->toISOString() }}">
                                                {{ $document->created_at->format('d.m.Y') }}
                                            </time>
                                        </div>

                                        <h3 class="text-sm font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200 leading-tight line-clamp-2">
                                            {{ $document->title }}
                                        </h3>

                                        @if($document->description)
                                            <p class="text-xs text-gray-600 mb-3 flex-1 line-clamp-2">
                                                {{ $document->description }}
                                            </p>
                                        @endif

                                        {{-- Files Info and Actions --}}
                                        <div class="mt-auto">
                                            <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    {{ count($fileUrls) }} 
                                                    {{ count($fileUrls) === 1 ? 'fișier' : 'fișiere' }}
                                                </span>
                                                @if($firstFile && $firstFile['size_formatted'])
                                                    <span>{{ $firstFile['size_formatted'] }}</span>
                                                @endif
                                            </div>

                                            {{-- Primary File Info --}}
                                            @if($firstFile)
                                                <div class="flex items-center justify-between p-2 bg-gray-50 rounded text-xs group/file hover:bg-gray-100 transition-colors duration-200">
                                                    <div class="flex items-center flex-1 min-w-0">
                                                        <span class="inline-block w-6 h-4 text-center text-xs font-bold bg-white rounded mr-2 leading-4 {{ $iconClass }}">
                                                            {{ strtoupper($extension) ?: 'DOC' }}
                                                        </span>
                                                        <span class="truncate font-medium" title="{{ $firstFile['original_name'] }}">{{ $firstFile['original_name'] }}</span>
                                                    </div>
                                                    <div class="flex gap-1 ml-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                        @if($document->canViewInline(0))
                                                            <button onclick="event.stopPropagation(); viewDocument('{{ $firstFile['url'] }}', '{{ $firstFile['original_name'] }}', '{{ $extension }}')"
                                                                    class="p-1 text-blue-600 hover:bg-blue-100 rounded transition-colors duration-200"
                                                                    title="Vezi {{ $firstFile['original_name'] }}">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                </svg>
                                                            </button>
                                                        @endif
                                                        <a href="{{ $firstFile['url'] }}" 
                                                           onclick="event.stopPropagation()"
                                                           download="{{ $firstFile['original_name'] }}"
                                                           class="p-1 text-green-600 hover:bg-green-100 rounded transition-colors duration-200"
                                                           title="Descarcă {{ $firstFile['original_name'] }}">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation Arrows --}}
        @if($documents->count() > 2)
            <button 
                @click="previousCards()"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-70 rounded-full p-3 shadow-lg transition-all duration-200 hover:scale-110 z-20 backdrop-blur-sm"
                style="margin-top: -20px;"
            >
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button 
                @click="nextCards()"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-70 rounded-full p-3 shadow-lg transition-all duration-200 hover:scale-110 z-20 backdrop-blur-sm"
                style="margin-top: -20px;"
            >
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        {{-- Dots Indicator --}}
        @if($documents->count() > 2)
            <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-1">
                @for($i = 0; $i < ceil($documents->count() / 2); $i++)
                    <button 
                        @click="goToIndex({{ $i }})"
                        class="w-2 h-2 rounded-full transition-all duration-200"
                        :class="currentIndex === {{ $i }} ? 'bg-blue-600 w-4' : 'bg-white bg-opacity-60 hover:bg-opacity-80'"
                    ></button>
                @endfor
            </div>
        @endif

        {{-- AutoPlay Toggle --}}
        <button 
            @click="$wire.toggleAutoPlay()"
            class="absolute top-3 right-3 bg-white bg-opacity-50 hover:bg-opacity-70 rounded-full p-2 shadow-lg transition-all duration-200 z-10 backdrop-blur-sm"
            :class="autoPlay ? 'text-green-600' : 'text-gray-400'"
        >
            <svg x-show="autoPlay" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6l5-3z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
            </svg>
            <svg x-show="!autoPlay" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>

        {{-- Documents Counter --}}
        <div class="absolute top-3 left-3 bg-white bg-opacity-50 rounded-full px-3 py-1 text-xs font-medium text-gray-700 backdrop-blur-sm">
            {{ $documents->count() }} documente
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

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
// Document viewer function
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
</div>