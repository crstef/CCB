<x-layouts.app>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
    </div>
    <x-container class="relative">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                <span class="block">Biblioteca de</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Documente</span>
            </h1>
            <p class="max-w-2xl mx-auto mt-6 text-xl text-gray-600">
                Accesează documentele importante ale clubului, organizate pe categorii pentru o navigare facilă.
            </p>
        </div>
    </x-container>
</div>

<!-- Category Filter Section -->
<div class="bg-white border-b border-gray-200">
    <x-container class="py-8">
        <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
            <h2 class="text-lg font-semibold text-gray-900">Categorii Documente</h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('documents.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 {{ !$selectedCategory ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Toate ({{ $categories->sum('documents_count') }})
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('documents.index', ['category' => $category->slug]) }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 {{ $selectedCategory === $category->slug ? 'text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                       style="{{ $selectedCategory === $category->slug ? 'background-color: ' . $category->color : '' }}">
                        <span class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $category->color }}"></span>
                        {{ $category->name }} ({{ $category->documents_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </x-container>
</div>

<!-- Documents Grid Section -->
<div class="bg-gray-50 py-8">
    <x-container>
        @if($documents->count() > 0)
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                @foreach($documents as $document)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 group overflow-hidden border border-gray-100">
                        <!-- Document Icon Header -->
                        <div class="relative h-20 bg-gradient-to-br from-{{ $document->category->color ?? 'blue' }}-50 to-{{ $document->category->color ?? 'blue' }}-100 flex items-center justify-center">
                            @php
                                $extension = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                                $iconClass = match($extension) {
                                    'pdf' => 'text-red-500',
                                    'doc', 'docx' => 'text-blue-500',
                                    'xls', 'xlsx' => 'text-green-500',
                                    'ppt', 'pptx' => 'text-orange-500',
                                    default => 'text-gray-500'
                                };
                            @endphp
                            <div class="relative">
                                <svg class="w-10 h-10 {{ $iconClass }} group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                                <div class="absolute -top-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                    <span class="text-xs font-bold uppercase text-gray-600">{{ $extension }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Document Content -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white" 
                                      style="background-color: {{ $document->category->color }}">
                                    {{ $document->category->name }}
                                </span>
                                <time class="text-xs text-gray-500" datetime="{{ $document->created_at->toISOString() }}">
                                    {{ $document->created_at->format('d.m.Y') }}
                                </time>
                            </div>

                            <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $document->title }}
                            </h3>

                            @if($document->description)
                                <p class="text-xs text-gray-600 mb-3 line-clamp-2">
                                    {{ $document->description }}
                                </p>
                            @endif

                            <!-- Document Metadata -->
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                @if($document->file_size)
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        {{ $document->getFileSizeFormatted() }}
                                    </span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <button onclick="viewDocument('{{ $document->getFileUrl() }}', '{{ $document->title }}', '{{ $extension }}')"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium rounded-md text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Vezi
                                </button>
                                <a href="{{ $document->getFileUrl() }}" 
                                   target="_blank"
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Descarcă
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="mt-8">
                    {{ $documents->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto h-24 w-24 text-gray-400">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="mt-6 text-lg font-medium text-gray-900">Nu există documente</h3>
                <p class="mt-2 text-gray-500">
                    @if($selectedCategory)
                        Nu au fost găsite documente în categoria selectată.
                    @else
                        Nu au fost încărcate încă documente în sistem.
                    @endif
                </p>
                @if($selectedCategory)
                    <div class="mt-6">
                        <a href="{{ route('documents.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Vezi toate documentele
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </x-container>
</div>

<!-- Document Viewer Modal -->
<div id="documentModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDocumentModal()"></div>
        
        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Document Viewer
                    </h3>
                    <button type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="closeDocumentModal()">
                        <span class="sr-only">Închide</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="w-full h-96 sm:h-[500px] lg:h-[600px] bg-gray-100 rounded-lg overflow-hidden">
                    <iframe id="documentFrame" 
                            class="w-full h-full border-0" 
                            src=""
                            title="Document Viewer">
                    </iframe>
                    
                    <!-- Loading spinner -->
                    <div id="documentLoading" class="flex items-center justify-center h-full">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                    </div>
                    
                    <!-- Error message for unsupported files -->
                    <div id="documentError" class="hidden flex flex-col items-center justify-center h-full text-center p-8">
                        <svg class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Preview indisponibil</h3>
                        <p class="text-gray-500 mb-4">Acest tip de fișier nu poate fi vizualizat în browser.</p>
                        <a id="downloadFallback" href="#" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Descarcă Fișierul
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="openInNewTab()">
                    Deschide în tab nou
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeDocumentModal()">
                    Închide
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-white border-t border-gray-200">
    <x-container class="py-16">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Ai nevoie de ajutor?
            </h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Dacă nu găsești documentul de care ai nevoie sau ai întrebări despre conținut, nu ezita să ne contactezi.
            </p>
            <a href="{{ route('page.show', 'contact') }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Contactează-ne
            </a>
        </div>
    </x-container>
</div>

@push('css')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('js')
<script>
let currentDocumentUrl = '';

function viewDocument(url, title, extension) {
    const modal = document.getElementById('documentModal');
    const frame = document.getElementById('documentFrame');
    const loading = document.getElementById('documentLoading');
    const error = document.getElementById('documentError');
    const modalTitle = document.getElementById('modal-title');
    const downloadFallback = document.getElementById('downloadFallback');
    
    currentDocumentUrl = url;
    modalTitle.textContent = title;
    downloadFallback.href = url;
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    // Reset states
    frame.style.display = 'none';
    loading.style.display = 'flex';
    error.classList.add('hidden');
    
    // Check if file type is viewable
    const viewableExtensions = ['pdf', 'txt', 'html'];
    const isViewable = viewableExtensions.includes(extension.toLowerCase());
    
    if (isViewable) {
        // For PDFs and other viewable files
        if (extension.toLowerCase() === 'pdf') {
            frame.src = url + '#view=FitH';
        } else {
            frame.src = url;
        }
        
        frame.onload = function() {
            loading.style.display = 'none';
            frame.style.display = 'block';
        };
        
        frame.onerror = function() {
            loading.style.display = 'none';
            error.classList.remove('hidden');
        };
        
        // Fallback timeout
        setTimeout(() => {
            if (loading.style.display !== 'none') {
                loading.style.display = 'none';
                error.classList.remove('hidden');
            }
        }, 5000);
    } else {
        // For non-viewable files, show error message immediately
        loading.style.display = 'none';
        error.classList.remove('hidden');
    }
}

function closeDocumentModal() {
    const modal = document.getElementById('documentModal');
    const frame = document.getElementById('documentFrame');
    
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    frame.src = '';
    currentDocumentUrl = '';
}

function openInNewTab() {
    if (currentDocumentUrl) {
        window.open(currentDocumentUrl, '_blank');
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDocumentModal();
    }
});
</script>
@endpush

</x-layouts.app>
