<x-layouts.marketing>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-20">
    <div class="absolute inset-0 bg                                                    @if($document->canViewInline($index))
                                                        <button onclick="viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')"
                                                                class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                                                title="Vezi {{ $file['original_name'] }}">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                            </svg>
                                                        </button>
                                                    @endif                                               <button onclick="viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')"
    <x-container class="relative">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                {{ $categories->sum('documents_count') }} documente disponibile
            </div>
            <h1 class="text-5xl font-bold tracking-tight text-gray-900 mb-6">
                <span class="block">Biblioteca de</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600">Documente</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                Accesează documentele importante ale clubului, organizate pe categorii pentru o navigare facilă. 
                Vizualizează online sau descarcă fișierele de care ai nevoie.
            </p>
        </div>
    </x-container>
</div>

<!-- Category Filter Section -->
<div class="bg-white border-b border-gray-100 sticky top-0 z-10 backdrop-blur-lg bg-white/95">
    <x-container class="py-6">
        <div class="flex flex-col space-y-6 lg:flex-row lg:items-center lg:justify-between lg:space-y-0">
            <!-- Category Filters -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('documents.index') }}" 
                   class="inline-flex items-center px-5 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ !$selectedCategory ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg shadow-blue-500/25' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Toate
                    <span class="ml-2 px-2 py-1 text-xs bg-white/20 rounded-full">{{ $categories->sum('documents_count') }}</span>
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('documents.index', ['category' => $category->slug]) }}" 
                       class="inline-flex items-center px-5 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ $selectedCategory === $category->slug ? 'text-white shadow-lg' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}"
                       style="{{ $selectedCategory === $category->slug ? 'background: linear-gradient(135deg, ' . $category->color . ', ' . $category->color . '88)' : '' }}">
                        <span class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $category->color }}"></span>
                        {{ $category->name }}
                        <span class="ml-2 px-2 py-1 text-xs {{ $selectedCategory === $category->slug ? 'bg-white/20' : 'bg-gray-200' }} rounded-full">{{ $category->documents_count }}</span>
                    </a>
                @endforeach
            </div>
            
            <!-- View Toggle -->
            @if($documents->count() > 0)
                <div class="flex items-center bg-gray-50 rounded-xl p-1 shadow-sm">
                    <button id="gridViewBtn" onclick="setViewMode('grid')" 
                            class="view-toggle-btn active flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Grilă
                    </button>
                    <button id="listViewBtn" onclick="setViewMode('list')" 
                            class="view-toggle-btn flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200">
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

<!-- Documents Section -->
<div class="bg-gray-50 py-12">
    <x-container>
        @if($documents->count() > 0)
            <!-- Grid View -->
            <div id="gridView" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($documents as $document)
                    @php
                        $fileUrls = $document->getFileUrls();
                        $firstFile = $fileUrls[0] ?? null;
                        $extension = $firstFile ? strtolower($firstFile['type']) : '';
                        $iconClass = $document->getFileIconClass(0);
                    @endphp
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-gray-200">
                        <!-- Document Header with Icon - Smaller -->
                        <div class="relative h-16 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center group-hover:from-blue-50 group-hover:to-indigo-100 transition-all duration-300">
                            <div class="relative">
                                @php
                                    $ext = strtolower($extension);
                                    $iconBg = match($ext) {
                                        'pdf' => 'text-red-500',
                                        'doc', 'docx' => 'text-blue-500',
                                        'xls', 'xlsx' => 'text-green-500',
                                        'ppt', 'pptx' => 'text-orange-500',
                                        'jpg', 'jpeg', 'png', 'gif', 'webp' => 'text-purple-500',
                                        'txt' => 'text-gray-500',
                                        default => 'text-blue-500'
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
                                <svg class="w-8 h-8 {{ $iconBg }} group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                    {!! $icon !!}
                                </svg>
                                @if($extension)
                                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-white rounded-full flex items-center justify-center shadow-lg border border-gray-100">
                                        <span class="text-xs font-bold uppercase text-gray-700">{{ substr($extension, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Document Content - More compact -->
                        <div class="p-4">
                            <!-- Category and Date -->
                            <div class="flex items-center justify-between mb-2">
                                @if($document->category)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white" 
                                          style="background-color: {{ $document->category->color }}">
                                        {{ $document->category->name }}
                                    </span>
                                @endif
                                <time class="text-xs text-gray-500" datetime="{{ $document->created_at->toISOString() }}">
                                    {{ $document->created_at->format('d.m.Y') }}
                                </time>
                            </div>

                            <!-- Title - Smaller -->
                            <h3 class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $document->title }}
                            </h3>

                            <!-- Description -->
                            @if($document->description)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ $document->description }}
                                </p>
                            @endif

                            <!-- Files Info -->
                            <div class="flex items-center justify-between text-sm mb-3">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-xs">{{ count($fileUrls) }} fișier{{ count($fileUrls) > 1 ? 'e' : '' }}</span>
                                </div>
                                @if($firstFile && $firstFile['size_formatted'])
                                    <span class="text-gray-400 text-xs">{{ $firstFile['size_formatted'] }}</span>
                                @endif
                            </div>

                            <!-- Files List Compact -->
                            @if(count($fileUrls) > 0)
                                <div class="space-y-1">
                                    @foreach($fileUrls as $index => $file)
                                        @if($index < 2) {{-- Show max 2 files in compact view --}}
                                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg text-sm group/file hover:bg-gray-100 transition-colors duration-200">
                                                <div class="flex items-center flex-1 min-w-0">
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
                                                    <span class="inline-block w-6 h-6 text-center text-xs font-bold {{ $iconBg }} text-white rounded mr-2 leading-6">
                                                        {{ strtoupper(substr($file['type'], 0, 1)) ?: 'D' }}
                                                    </span>
                                                    <span class="truncate font-medium text-xs" title="{{ $file['original_name'] }}">{{ $file['original_name'] }}</span>
                                                </div>
                                                <div class="flex gap-2 ml-2">
                                                    @if($document->canViewInline($index))
                                                        <a href="{{ $file['url'] }}" 
                                                           target="_blank"
                                                           class="p-1 text-blue-600 hover:bg-blue-100 rounded transition-colors duration-200"
                                                           title="Vezi {{ $file['original_name'] }}">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                    <a href="{{ $file['url'] }}" 
                                                       download="{{ $file['original_name'] }}"
                                                       class="p-2 text-green-600 hover:bg-green-100 rounded-lg transition-colors duration-200"
                                                       title="Descarcă {{ $file['original_name'] }}">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if(count($fileUrls) > 2)
                                        <a href="{{ route('documents.show', $document) }}" 
                                           class="block w-full text-center py-1 text-xs text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                            +{{ count($fileUrls) - 2 }} fișiere suplimentare
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="listView" class="hidden space-y-4">
                @foreach($documents as $document)
                    @php
                        $fileUrls = $document->getFileUrls();
                        $firstFile = $fileUrls[0] ?? null;
                        $extension = $firstFile ? strtolower($firstFile['type']) : '';
                        $iconClass = $document->getFileIconClass(0);
                    @endphp
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-start gap-4">
                                <!-- Document Icon - Smaller -->
                                <div class="flex-shrink-0">
                                    <div class="relative p-3 bg-gray-50 rounded-xl">
                                        @php
                                            $ext = strtolower($extension);
                                            $iconBg = match($ext) {
                                                'pdf' => 'text-red-500',
                                                'doc', 'docx' => 'text-blue-500',
                                                'xls', 'xlsx' => 'text-green-500',
                                                'ppt', 'pptx' => 'text-orange-500',
                                                'jpg', 'jpeg', 'png', 'gif', 'webp' => 'text-purple-500',
                                                'txt' => 'text-gray-500',
                                                default => 'text-blue-500'
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
                                        <svg class="w-6 h-6 {{ $iconBg }}" fill="currentColor" viewBox="0 0 24 24">
                                            {!! $icon !!}
                                        </svg>
                                        @if($extension)
                                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-white rounded-full flex items-center justify-center shadow-sm border">
                                                <span class="text-xs font-bold uppercase text-gray-600">{{ substr($extension, 0, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Document Info -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header -->
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex items-center gap-3">
                                            @if($document->category)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white" 
                                                      style="background-color: {{ $document->category->color }}">
                                                    {{ $document->category->name }}
                                                </span>
                                            @endif
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
                                        <p class="text-gray-600 mb-3 line-clamp-2">
                                            {{ $document->description }}
                                        </p>
                                    @endif

                                    <!-- Files Grid in List View -->
                                    @if(count($fileUrls) > 0)
                                        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                                            @foreach($fileUrls as $index => $file)
                                                <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                                    <div class="flex items-center flex-1 min-w-0">
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
                                                        <span class="inline-block w-7 h-7 text-center text-xs font-bold {{ $iconBg }} text-white rounded mr-2 leading-7">
                                                            {{ strtoupper(substr($file['type'], 0, 1)) ?: 'D' }}
                                                        </span>
                                                        <div class="min-w-0 flex-1">
                                                            <p class="truncate font-medium text-sm" title="{{ $file['original_name'] }}">{{ $file['original_name'] }}</p>
                                                            @if($file['size_formatted'])
                                                                <p class="text-xs text-gray-500">{{ $file['size_formatted'] }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex gap-1 ml-2">
                                                        @if($document->canViewInline($index))
                                                            <button onclick="viewDocument('{{ $file['url'] }}', '{{ $file['original_name'] }}', '{{ $file['type'] }}')"
                                                                    class="p-1.5 text-blue-600 hover:bg-blue-100 rounded transition-colors duration-200"
                                                                    title="Vezi {{ $file['original_name'] }}">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                </svg>
                                                            </button>
                                                        @endif
                                                        <a href="{{ $file['url'] }}" 
                                                           download="{{ $file['original_name'] }}"
                                                           class="p-1.5 text-green-600 hover:bg-green-100 rounded transition-colors duration-200"
                                                           title="Descarcă {{ $file['original_name'] }}">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
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
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="mt-12">
                    {{ $documents->appends(request()->query())->links() }}
                </div>
            @endif

        @else
            <!-- No Documents Message -->
            <div class="flex flex-col items-center justify-center py-24 text-gray-500">
                <div class="p-6 bg-gray-100 rounded-full mb-6">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nu există documente disponibile</h3>
                <p class="text-gray-600 text-center max-w-md">
                    @if($selectedCategory)
                        Nu există documente în categoria selectată momentan.
                    @else
                        Documentele vor apărea aici când vor fi adăugate de administratori.
                    @endif
                </p>
                @if($selectedCategory)
                    <a href="{{ route('documents.index') }}" 
                       class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Vezi toate documentele
                    </a>
                @endif
            </div>
        @endif
    </x-container>
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
// View mode toggle
function setViewMode(mode) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    
    if (mode === 'grid') {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        gridView.classList.add('hidden');
        listView.classList.remove('hidden');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
    }
    
    // Save preference
    localStorage.setItem('documentsViewMode', mode);
}

// Load saved view mode
document.addEventListener('DOMContentLoaded', function() {
    const savedMode = localStorage.getItem('documentsViewMode') || 'grid';
    setViewMode(savedMode);
});

// Document viewer
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
document.getElementById('documentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDocumentModal();
    }
});
</script>

<style>
.view-toggle-btn.active {
    @apply bg-white text-gray-900 shadow-sm;
}

.view-toggle-btn:not(.active) {
    @apply text-gray-500 hover:text-gray-700;
}

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

.bg-grid-pattern {
    background-image: radial-gradient(circle, #e5e7eb 1px, transparent 1px);
    background-size: 20px 20px;
}
</style>

</x-layouts.marketing>
