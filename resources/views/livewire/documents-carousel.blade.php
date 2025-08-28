<div>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .document-preview-iframe {
            pointer-events: none;
            border: none;
            width: 100%;
            height: 100%;
        }
        
        /* Scroll styling for file list */
        .document-files-scroll {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 transparent;
        }
        
        .document-files-scroll::-webkit-scrollbar {
            width: 4px;
        }
        
        .document-files-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .document-files-scroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 2px;
        }
    </style>

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
        {{-- Header --}}
        <div class="absolute top-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-b border-gray-200 p-4 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Documente Recente</h2>
                    <p class="text-sm text-gray-600">{{ $documents->count() }} documente disponibile</p>
                </div>
                
                {{-- Navigation Arrows --}}
                @if($documents->count() > 2)
                    <div class="flex gap-2">
                        <button @click="previousCards()" 
                                class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextCards()" 
                                class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        {{-- Documents Container --}}
        <div class="pt-20 pb-4 px-4 h-full">
            <div class="overflow-hidden h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full"
                     :style="`transform: translateX(-${currentIndex * (100 / cardsPerView)}%)`">
                    
                    @foreach($documents as $document)
                        @php
                            $fileUrls = $document->getFileUrls();
                            $firstFile = $fileUrls[0] ?? null;
                            $extension = $firstFile ? $firstFile['type'] : null;
                            $iconClass = $document->getFileIconClass(0);
                        @endphp
                        
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            {{-- Enhanced Compact Document Card --}}
                            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group h-80">
                                {{-- Document Preview Area --}}
                                <div class="relative h-40 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                                    @if($firstFile && $extension === 'pdf')
                                        {{-- PDF Preview --}}
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <iframe src="{{ $firstFile['url'] }}#toolbar=0&navpanes=0&scrollbar=0&page=1" 
                                                    class="w-full h-full border-0 pointer-events-none scale-110 origin-center"
                                                    style="transform: scale(1.1);">
                                            </iframe>
                                            <div class="absolute inset-0 bg-white bg-opacity-20"></div>
                                        </div>
                                    @elseif($firstFile)
                                        {{-- Document Icon for non-PDF files --}}
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-16 h-20 {{ $iconClass }} rounded-lg flex items-center justify-center shadow-lg">
                                                <span class="text-2xl font-bold">{{ strtoupper($extension) ?: 'DOC' }}</span>
                                            </div>
                                        </div>
                                    @else
                                        {{-- No file fallback --}}
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-16 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    {{-- Category Badge --}}
                                    @if($document->category)
                                        <div class="absolute top-3 left-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white shadow-lg"
                                                  style="background-color: {{ $document->category->color }}">
                                                {{ $document->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                    {{-- Multiple Files Badge --}}
                                    @if(count($fileUrls) > 1)
                                        <div class="absolute top-3 right-3">
                                            <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded-full shadow-lg">
                                                {{ count($fileUrls) }} fișiere
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Document Content --}}
                                <div class="p-4 flex flex-col h-40">
                                    {{-- Title & Date --}}
                                    <div class="flex-shrink-0 mb-2">
                                        <h3 class="font-semibold text-gray-900 line-clamp-2 text-sm group-hover:text-blue-600 transition-colors duration-200">
                                            {{ $document->title }}
                                        </h3>
                                        <time class="text-xs text-gray-500 mt-1">{{ $document->created_at->format('d.m.Y') }}</time>
                                    </div>

                                    {{-- Description --}}
                                    @if($document->description)
                                        <p class="text-xs text-gray-600 line-clamp-2 flex-grow mb-3">
                                            {{ $document->description }}
                                        </p>
                                    @endif

                                    {{-- File Actions - All Attachments --}}
                                    <div class="mt-auto space-y-1 max-h-20 overflow-y-auto document-files-scroll">
                                        @foreach($fileUrls as $fileIndex => $file)
                                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                                <div class="flex items-center flex-1 min-w-0">
                                                    <span class="inline-block w-8 h-5 text-center text-xs font-bold text-white rounded mr-2 leading-5 {{ match($file['type']) {
                                                        'pdf' => 'bg-red-500',
                                                        'doc', 'docx' => 'bg-blue-500',
                                                        'xls', 'xlsx' => 'bg-green-500',
                                                        'ppt', 'pptx' => 'bg-orange-500',
                                                        default => 'bg-gray-500'
                                                    } }}">
                                                        {{ strtoupper($file['type']) ?: 'DOC' }}
                                                    </span>
                                                    <span class="truncate text-xs font-medium" title="{{ $file['original_name'] }}">
                                                        {{ Str::limit($file['original_name'], 25) }}
                                                    </span>
                                                </div>
                                                <div class="flex gap-1 ml-2">
                                                    {{-- View Button --}}
                                                    @if($document->canViewInline($fileIndex))
                                                        <button onclick="event.stopPropagation(); viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')"
                                                                class="p-1.5 text-blue-600 hover:bg-blue-100 rounded-md transition-colors duration-200"
                                                                title="Vezi {{ $file['original_name'] }}">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                    {{-- Download Button --}}
                                                    <a href="{{ $file['url'] }}" 
                                                       onclick="event.stopPropagation()"
                                                       download="{{ $file['original_name'] }}"
                                                       class="p-1.5 text-green-600 hover:bg-green-100 rounded-md transition-colors duration-200"
                                                       title="Descarcă {{ $file['original_name'] }}">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 4H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Navigation Dots --}}
        @if($documents->count() > 2)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                @for($i = 0; $i < max(1, $documents->count() - 1); $i++)
                    <button @click="goToIndex({{ $i }})" 
                            class="w-2 h-2 rounded-full transition-colors duration-200"
                            :class="currentIndex === {{ $i }} ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'">
                    </button>
                @endfor
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
        console.log('viewDocument called with:', {url, name, type});
        
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
                modalContent.innerHTML = `
                    <iframe src="${url}" 
                            class="w-full h-full border-0" 
                            title="${name}">
                        <p>Browser-ul dumneavoastră nu suportă vizualizarea PDF-urilor. <a href="${url}" target="_blank">Deschideți în tab nou</a></p>
                    </iframe>
                `;
            } else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(extension)) {
                const officeViewerUrl = `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(window.location.origin + url)}`;
                modalContent.innerHTML = `
                    <iframe src="${officeViewerUrl}" 
                            class="w-full h-full border-0" 
                            title="${name}">
                        <p>Nu se poate încărca previzualizarea. <a href="${url}" target="_blank">Deschideți în tab nou</a></p>
                    </iframe>
                `;
            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extension)) {
                modalContent.innerHTML = `
                    <div class="flex items-center justify-center h-full p-4">
                        <img src="${url}" alt="${name}" class="max-w-full max-h-full object-contain">
                    </div>
                `;
            } else if (extension === 'txt') {
                fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(text => {
                        modalContent.innerHTML = `
                            <div class="p-6 h-full overflow-auto">
                                <pre class="whitespace-pre-wrap text-sm font-mono">${text}</pre>
                            </div>
                        `;
                    })
                    .catch(error => {
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
                return;
            } else {
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
    document.getElementById('documentModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDocumentModal();
        }
    });
    </script>
</div>
