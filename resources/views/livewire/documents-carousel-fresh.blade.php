<div>
    <div 
        x-data="{ 
            currentIndex: 0,
            documentsCount: {{ $documents->count() }},
            cardsPerView: 2,
            autoPlayInterval: null,
            init() {
                this.updateCardsPerView();
                this.startAutoPlay();
                window.addEventListener('resize', () => this.updateCardsPerView());
            },
            updateCardsPerView() {
                this.cardsPerView = window.innerWidth >= 1024 ? 2 : 1;
            },
            startAutoPlay() {
                if (this.documentsCount > this.cardsPerView) {
                    this.autoPlayInterval = setInterval(() => {
                        this.nextSlide();
                    }, 4000);
                }
            },
            stopAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
            },
            nextSlide() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                this.currentIndex = this.currentIndex >= maxIndex ? 0 : this.currentIndex + 1;
            },
            prevSlide() {
                const maxIndex = Math.max(0, this.documentsCount - this.cardsPerView);
                this.currentIndex = this.currentIndex <= 0 ? maxIndex : this.currentIndex - 1;
                this.stopAutoPlay();
                this.startAutoPlay();
            }
        }"
        @mouseenter="stopAutoPlay()"
        @mouseleave="startAutoPlay()"
        class="relative {{ $height }} w-full bg-gradient-to-br from-blue-50 to-gray-100 rounded-2xl shadow-lg overflow-hidden">
        
        <!-- Header -->
        <div class="absolute top-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-b border-gray-200 p-4 z-20">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Documente Recente</h2>
                </div>
                
                @if($documents->count() > 2)
                    <div class="flex gap-2">
                        <button @click="prevSlide()" 
                                class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextSlide()" 
                                class="p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Carousel Container -->
        <div class="pt-24 pb-4 px-4 h-full">
            <div class="overflow-hidden h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full"
                     :style="`transform: translateX(-${currentIndex * (100 / cardsPerView)}%)`">
                    
                    @foreach($documents as $document)
                        <div class="w-full lg:w-1/2 flex-shrink-0 px-2 h-full">
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-3 h-full flex flex-col group cursor-pointer border border-gray-100 hover:border-blue-200"
                                 onclick="window.location='{{ route('documents.show', $document->id) }}'">
                                
                                <!-- Document Header -->
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        @if($document->category)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white"
                                                  style="background-color: {{ $document->category->color }}">
                                                {{ $document->category->name }}
                                            </span>
                                        @endif
                                        <time class="text-xs text-gray-500">{{ $document->created_at->format('d.m.Y') }}</time>
                                    </div>
                                    
                                    @php
                                        $fileUrls = $document->getFileUrls();
                                    @endphp
                                    @if(count($fileUrls) > 1)
                                        <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                                            {{ count($fileUrls) }} fișiere
                                        </span>
                                    @endif
                                </div>

                                <!-- Document Title -->
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200 text-sm">
                                    {{ $document->title }}
                                </h3>

                                <!-- Document Description -->
                                @if($document->description)
                                    <p class="text-xs text-gray-600 mb-2 line-clamp-2 flex-grow">
                                        {{ $document->description }}
                                    </p>
                                @endif

                                <!-- File Count Info -->
                                @if(count($fileUrls) > 0)
                                    <div class="flex items-center p-2 bg-gray-50 rounded text-xs mt-auto">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span class="text-gray-600">
                                            {{ count($fileUrls) }} {{ count($fileUrls) == 1 ? 'fișier atașat' : 'fișiere atașate' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Navigation Dots -->
        @if($documents->count() > 2)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                @for($i = 0; $i < max(1, $documents->count() - 1); $i++)
                    <button @click="currentIndex = {{ $i }}; stopAutoPlay(); startAutoPlay();" 
                            class="w-2 h-2 rounded-full transition-colors duration-200"
                            :class="currentIndex === {{ $i }} ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'">
                    </button>
                @endfor
            </div>
        @endif

        @endif

        <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        </style>
    </div>        <style>
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
            
            if (!modal || !modalTitle || !modalContent) {
                console.error('Modal elements not found');
                return;
            }
            
            // Show modal first
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            modalTitle.textContent = name;
            
            // Show loading state
            modalContent.innerHTML = \`
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-gray-600">Se încarcă documentul...</p>
                    </div>
                </div>
            \`;
            
            const extension = type.toLowerCase();
            
            // Small delay to ensure modal is visible
            setTimeout(() => {
                if (extension === 'pdf') {
                    modalContent.innerHTML = \`
                        <iframe src="\${url}" 
                                class="w-full h-full border-0" 
                                title="\${name}">
                            <p>Browser-ul dumneavoastră nu suportă vizualizarea PDF-urilor. <a href="\${url}" target="_blank">Deschideți în tab nou</a></p>
                        </iframe>
                    \`;
                } else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(extension)) {
                    const officeViewerUrl = \`https://view.officeapps.live.com/op/embed.aspx?src=\${encodeURIComponent(window.location.origin + url)}\`;
                    modalContent.innerHTML = \`
                        <iframe src="\${officeViewerUrl}" 
                                class="w-full h-full border-0" 
                                title="\${name}">
                            <p>Nu se poate încărca previzualizarea. <a href="\${url}" target="_blank">Deschideți în tab nou</a></p>
                        </iframe>
                    \`;
                } else if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extension)) {
                    modalContent.innerHTML = \`
                        <div class="flex items-center justify-center h-full p-4">
                            <img src="\${url}" alt="\${name}" class="max-w-full max-h-full object-contain">
                        </div>
                    \`;
                } else if (extension === 'txt') {
                    fetch(url)
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.text();
                        })
                        .then(text => {
                            modalContent.innerHTML = \`
                                <div class="p-6 h-full overflow-auto">
                                    <pre class="whitespace-pre-wrap text-sm font-mono">\${text}</pre>
                                </div>
                            \`;
                        })
                        .catch(error => {
                            modalContent.innerHTML = \`
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center">
                                        <p class="text-lg font-medium text-gray-900 mb-2">Nu se poate încărca fișierul</p>
                                        <a href="\${url}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            Deschide în tab nou
                                        </a>
                                    </div>
                                </div>
                            \`;
                        });
                    return;
                } else {
                    modalContent.innerHTML = \`
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium text-gray-900 mb-2">Previzualizare indisponibilă</p>
                                <p class="text-gray-600 mb-4">Acest tip de fișier nu poate fi previzualizat în browser.</p>
                                <a href="\${url}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Deschide în tab nou
                                </a>
                            </div>
                        </div>
                    \`;
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
