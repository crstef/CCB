<x-layouts.marketing>

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
        <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0">
            <h2 class="text-lg font-semibold text-gray-900">Categorii Documente</h2>
        </div>
        
        <!-- Category Filters and View Toggle -->
        <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 mt-4">
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
            
            <!-- View Toggle - Moved to the right -->
            @if($documents->count() > 0)
                <div class="flex items-center bg-gray-100 rounded-lg p-1">
                    <button id="gridViewBtn" onclick="setViewMode('grid')" 
                            class="view-toggle-btn active flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Grid
                    </button>
                    <button id="listViewBtn" onclick="setViewMode('list')" 
                            class="view-toggle-btn flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Listă
                    </button>
                </div>
            @endif
        </div>
    </x-container>
</div>

<!-- Documents Grid Section -->
<div class="bg-gray-50 py-8">
    <x-container>
        @if($documents->count() > 0)
            <!-- Grid View -->
            <div id="gridView" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                @foreach($documents as $document)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 group overflow-hidden border border-gray-100">
                        <!-- Document Icon Header -->
                        <div class="relative h-20 bg-gradient-to-br from-{{ $document->category->color ?? 'blue' }}-50 to-{{ $document->category->color ?? 'blue' }}-100 flex items-center justify-center">
                            @php
                                // Get extension from first file if files exist, otherwise use empty string
                                $files = $document->files ?? [];
                                if (is_array($files) && count($files) > 0) {
                                    $firstFile = $files[0];
                                    // Handle Filament file structure
                                    if (is_array($firstFile)) {
                                        $firstFilePath = $firstFile['path'] ?? $firstFile['url'] ?? $firstFile[0] ?? '';
                                        if (!$firstFilePath && isset($firstFile['name'])) {
                                            $firstFilePath = $firstFile['name'];
                                        }
                                    } else {
                                        $firstFilePath = is_string($firstFile) ? $firstFile : '';
                                    }
                                } else {
                                    $firstFilePath = '';
                                }
                                
                                $extension = $firstFilePath ? strtolower(pathinfo($firstFilePath, PATHINFO_EXTENSION)) : '';
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
                                    <span class="text-xs font-bold uppercase text-gray-600">{{ $extension ?: 'DOC' }}</span>
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

                            <!-- Files Count and Metadata -->
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ count($document->files ?? []) }} fișier{{ count($document->files ?? []) > 1 ? 'e' : '' }}
                                </span>
                                @if($document->file_size)
                                    <span class="flex items-center">
                                        {{ $document->getFileSizeFormatted() }}
                                    </span>
                                @endif
                            </div>

                            <!-- Files List -->
                            @if($document->files && count($document->files) > 0)
                                <div class="space-y-2 mb-3">
                                    @foreach($document->files as $index => $file)
                                        @php
                                            // Handle Filament file structure - files are stored as arrays
                                            if (is_array($file)) {
                                                // Filament stores files as arrays with metadata
                                                $filePath = $file['path'] ?? $file['url'] ?? $file[0] ?? '';
                                                if (!$filePath && isset($file['name'])) {
                                                    // Sometimes the path might be in a different key
                                                    $filePath = $file['name'];
                                                }
                                            } else {
                                                // Fallback for string paths
                                                $filePath = is_string($file) ? $file : '';
                                            }
                                            
                                            $fileUrl = $filePath ? Storage::url($filePath) : '';
                                            $fileName = $filePath ? basename($filePath) : 'Unknown';
                                            $fileExtension = $filePath ? strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) : '';
                                        @endphp
                                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded border text-xs">
                                            <div class="flex items-center flex-1 min-w-0">
                                                <span class="inline-block w-8 h-5 text-center text-xs font-bold bg-gray-300 rounded mr-2 leading-5">
                                                    {{ strtoupper($fileExtension) ?: 'DOC' }}
                                                </span>
                                                <span class="truncate" title="{{ $fileName }}">{{ $fileName }}</span>
                                            </div>
                                            <div class="flex gap-1 ml-2">
                                                @if($fileUrl && $fileUrl !== '#')
                                                    <button onclick="viewDocument('{{ $fileUrl }}', '{{ $fileName }}', '{{ $fileExtension }}')"
                                                            class="p-1 text-blue-600 hover:bg-blue-100 rounded transition-colors duration-200"
                                                            title="Vezi fișierul">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </button>
                                                    <a href="{{ $fileUrl }}" 
                                                       target="_blank"
                                                       class="p-1 text-green-600 hover:bg-green-100 rounded transition-colors duration-200"
                                                       title="Descarcă fișierul">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <span class="text-xs text-gray-400">Fișier indisponibil</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="listView" class="hidden space-y-4">
                @foreach($documents as $document)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 p-6">
                        <div class="flex items-start justify-between">
                            <!-- Left side - Document info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-3">
                                    <!-- Document Icon -->
                                    @php
                                        // Get extension from first file if files exist, otherwise use empty string
                                        $files = $document->files ?? [];
                                        if (is_array($files) && count($files) > 0) {
                                            $firstFile = $files[0];
                                            // Handle Filament file structure
                                            if (is_array($firstFile)) {
                                                $firstFilePath = $firstFile['path'] ?? $firstFile['url'] ?? $firstFile[0] ?? '';
                                                if (!$firstFilePath && isset($firstFile['name'])) {
                                                    $firstFilePath = $firstFile['name'];
                                                }
                                            } else {
                                                $firstFilePath = is_string($firstFile) ? $firstFile : '';
                                            }
                                        } else {
                                            $firstFilePath = '';
                                        }
                                        
                                        $extension = $firstFilePath ? strtolower(pathinfo($firstFilePath, PATHINFO_EXTENSION)) : '';
                                        $iconClass = match($extension) {
                                            'pdf' => 'text-red-500',
                                            'doc', 'docx' => 'text-blue-500',
                                            'xls', 'xlsx' => 'text-green-500',
                                            'ppt', 'pptx' => 'text-orange-500',
                                            default => 'text-gray-500'
                                        };
                                    @endphp
                                    <div class="relative flex-shrink-0">
                                        <svg class="w-8 h-8 {{ $iconClass }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-white rounded-full flex items-center justify-center shadow-sm">
                                            <span class="text-xs font-bold uppercase text-gray-600" style="font-size: 8px;">{{ $extension ?: 'DOC' }}</span>
                                        </div>
                                    </div>

                                    <!-- Category and Date -->
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white" 
                                              style="background-color: {{ $document->category->color }}">
                                            {{ $document->category->name }}
                                        </span>
                                        <time class="text-sm text-gray-500" datetime="{{ $document->created_at->toISOString() }}">
                                            {{ $document->created_at->format('d.m.Y') }}
                                        </time>
                                    </div>
                                </div>

                                <!-- Title and Description -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors duration-200">
                                    {{ $document->title }}
                                </h3>

                                @if($document->description)
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ $document->description }}
                                    </p>
                                @endif

                                <!-- Files Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ count($document->files ?? []) }} fișier{{ count($document->files ?? []) > 1 ? 'e' : '' }}
                                    @if($document->file_size)
                                        • {{ $document->getFileSizeFormatted() }}
                                    @endif
                                </div>

                                <!-- Files List in List View -->
                                @if($document->files && count($document->files) > 0)
                                    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                                        @foreach($document->files as $index => $file)
                                            @php
                                                // Handle Filament file structure - files are stored as arrays
                                                if (is_array($file)) {
                                                    // Filament stores files as arrays with metadata
                                                    $filePath = $file['path'] ?? $file['url'] ?? $file[0] ?? '';
                                                    if (!$filePath && isset($file['name'])) {
                                                        // Sometimes the path might be in a different key
                                                        $filePath = $file['name'];
                                                    }
                                                } else {
                                                    // Fallback for string paths
                                                    $filePath = is_string($file) ? $file : '';
                                                }
                                                
                                                $fileUrl = $filePath ? Storage::url($filePath) : '';
                                                $fileName = $filePath ? basename($filePath) : 'Unknown';
                                                $fileExtension = $filePath ? strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) : '';
                                            @endphp
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border text-sm">
                                                <div class="flex items-center flex-1 min-w-0">
                                                    <span class="inline-block w-10 h-6 text-center text-xs font-bold bg-gray-300 rounded mr-3 leading-6">
                                                        {{ strtoupper($fileExtension) ?: 'DOC' }}
                                                    </span>
                                                    <span class="truncate" title="{{ $fileName }}">{{ $fileName }}</span>
                                                </div>
                                                <div class="flex gap-2 ml-3">
                                                    <button onclick="viewDocument('{{ $fileUrl }}', '{{ $fileName }}', '{{ $fileExtension }}')"
                                                            class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                                            title="Vezi fișierul">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </button>
                                                    <a href="{{ $fileUrl }}" 
                                                       target="_blank"
                                                       class="p-2 text-green-600 hover:bg-green-100 rounded-lg transition-colors duration-200"
                                                       title="Descarcă fișierul">
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
    
    /* View Toggle Styles */
    .view-toggle-btn {
        color: #6b7280;
        background-color: transparent;
    }
    
    .view-toggle-btn.active {
        color: #3b82f6;
        background-color: white;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
    
    .view-toggle-btn:hover:not(.active) {
        color: #374151;
        background-color: #f9fafb;
    }
</style>
@endpush

@push('js')
<script>
let currentDocumentUrl = '';
let currentViewMode = 'grid'; // Default view mode

// View mode toggle functionality
function setViewMode(mode) {
    console.log('Setting view mode to:', mode); // Debug log
    currentViewMode = mode;
    localStorage.setItem('documentsViewMode', mode);
    
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    
    console.log('Elements found:', {
        gridView: !!gridView,
        listView: !!listView,
        gridBtn: !!gridBtn,
        listBtn: !!listBtn
    }); // Debug log
    
    if (mode === 'grid') {
        if (gridView) gridView.classList.remove('hidden');
        if (listView) listView.classList.add('hidden');
        if (gridBtn) gridBtn.classList.add('active');
        if (listBtn) listBtn.classList.remove('active');
    } else {
        if (gridView) gridView.classList.add('hidden');
        if (listView) listView.classList.remove('hidden');
        if (listBtn) listBtn.classList.add('active');
        if (gridBtn) gridBtn.classList.remove('active');
    }
}

// Initialize view mode on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded'); // Debug log
    // Load saved view mode or default to grid
    const savedViewMode = localStorage.getItem('documentsViewMode') || 'grid';
    console.log('Saved view mode:', savedViewMode); // Debug log
    setViewMode(savedViewMode);
    
    const modal = document.getElementById('documentModal');
    const frame = document.getElementById('documentFrame');
    console.log('Modal exists:', !!modal);
    console.log('Frame exists:', !!frame);
});

function viewDocument(url, title, extension) {
    console.log('Opening document:', { url, title, extension }); // Debug log
    
    // Check if URL is valid
    if (!url || url.trim() === '' || url === '#') {
        console.error('Invalid or empty URL provided:', url);
        alert('Fișierul nu poate fi accesat. URL invalid sau lipsește.');
        return;
    }
    
    const modal = document.getElementById('documentModal');
    const frame = document.getElementById('documentFrame');
    const loading = document.getElementById('documentLoading');
    const error = document.getElementById('documentError');
    const modalTitle = document.getElementById('modal-title');
    const downloadFallback = document.getElementById('downloadFallback');
    
    console.log('Modal elements:', {
        modal: !!modal,
        frame: !!frame,
        loading: !!loading,
        error: !!error,
        modalTitle: !!modalTitle,
        downloadFallback: !!downloadFallback
    }); // Debug log
    
    if (!modal || !frame) {
        console.error('Modal elements not found');
        alert('Eroare: Elementele modal nu au fost găsite.');
        return;
    }
    
    currentDocumentUrl = url;
    if (modalTitle) modalTitle.textContent = title;
    if (downloadFallback) downloadFallback.href = url;
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    console.log('Modal should be visible now'); // Debug log
    
    // Reset states
    if (frame) frame.style.display = 'none';
    if (loading) loading.style.display = 'flex';
    if (error) error.classList.add('hidden');
    
    // Check if file type is viewable
    const viewableExtensions = ['pdf', 'txt', 'html', 'jpg', 'jpeg', 'png', 'gif', 'doc', 'docx'];
    const isViewable = viewableExtensions.includes(extension.toLowerCase());
    
    console.log('File viewable:', isViewable, 'Extension:', extension); // Debug log
    
    if (isViewable) {
        // For PDFs and other viewable files
        if (extension.toLowerCase() === 'pdf') {
            frame.src = url + '#view=FitH&toolbar=1';
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension.toLowerCase())) {
            // For images, show in iframe
            frame.src = 'data:text/html;charset=utf-8,' + encodeURIComponent(`
                <html>
                    <head>
                        <style>
                            body { margin: 0; padding: 20px; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
                            img { max-width: 100%; max-height: 100%; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
                        </style>
                    </head>
                    <body>
                        <img src="${url}" alt="${title}" />
                    </body>
                </html>
            `);
        } else {
            frame.src = url;
        }
        
        frame.onload = function() {
            console.log('Frame loaded successfully'); // Debug log
            if (loading) loading.style.display = 'none';
            if (frame) frame.style.display = 'block';
        };
        
        frame.onerror = function() {
            console.log('Frame load error'); // Debug log
            if (loading) loading.style.display = 'none';
            if (error) error.classList.remove('hidden');
        };
        
        // Fallback timeout
        setTimeout(() => {
            if (loading && loading.style.display !== 'none') {
                console.log('Loading timeout reached'); // Debug log
                loading.style.display = 'none';
                if (error) error.classList.remove('hidden');
            }
        }, 8000);
    } else {
        // For non-viewable files, show error message immediately
        console.log('File type not viewable:', extension); // Debug log
        if (loading) loading.style.display = 'none';
        if (error) error.classList.remove('hidden');
    }
}

function closeDocumentModal() {
    const modal = document.getElementById('documentModal');
    const frame = document.getElementById('documentFrame');
    
    if (modal) modal.classList.add('hidden');
    if (frame) frame.src = '';
    document.body.classList.remove('overflow-hidden');
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

// Make functions global for debugging
window.setViewMode = setViewMode;
window.viewDocument = viewDocument;
window.closeDocumentModal = closeDocumentModal;
window.openInNewTab = openInNewTab;
</script>
@endpush

</x-layouts.marketing>
