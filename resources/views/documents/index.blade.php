@extends('theme::layouts.app')

@section('content')

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
<div class="bg-gray-50 py-12">
    <x-container>
        @if($documents->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($documents as $document)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 group overflow-hidden border border-gray-100">
                        <!-- Document Icon Header -->
                        <div class="relative h-32 bg-gradient-to-br from-{{ $document->category->color ?? 'blue' }}-50 to-{{ $document->category->color ?? 'blue' }}-100 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/5"></div>
                            @php
                                $extension = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                                $iconClass = match($extension) {
                                    'pdf' => 'text-red-500',
                                    'doc', 'docx' => 'text-blue-500',
                                    'xls', 'xlsx' => 'text-green-500',
                                    'ppt', 'pptx' => 'text-orange-500',
                                    default => 'text-gray-500'
                                };
                                $iconPath = match($extension) {
                                    'pdf' => 'M7 18A1.5 1.5 0 0 0 8.5 19.5h7A1.5 1.5 0 0 0 17 18V7.828a2 2 0 0 0-.586-1.414l-2.828-2.828A2 2 0 0 0 12.172 3H8.5A1.5 1.5 0 0 0 7 4.5V18z',
                                    'doc', 'docx' => 'M9 2a1 1 0 000 2h6a1 1 0 100-2H9z M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6h-1a1 1 0 00-1 1v4H6v-4a1 1 0 00-1-1H4V5z',
                                    default => 'M9 2a1 1 0 000 2h6a1 1 0 100-2H9z M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6h-1a1 1 0 00-1 1v4H6v-4a1 1 0 00-1-1H4V5z'
                                };
                            @endphp
                            <div class="relative">
                                <svg class="w-16 h-16 {{ $iconClass }} group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $iconPath }}"/>
                                </svg>
                                <div class="absolute -top-1 -right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-sm">
                                    <span class="text-xs font-bold uppercase text-gray-600">{{ $extension }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Document Content -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" 
                                      style="background-color: {{ $document->category->color }}">
                                    {{ $document->category->name }}
                                </span>
                                <time class="text-xs text-gray-500" datetime="{{ $document->created_at->toISOString() }}">
                                    {{ $document->created_at->format('d.m.Y') }}
                                </time>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $document->title }}
                            </h3>

                            @if($document->description)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                    {{ $document->description }}
                                </p>
                            @endif

                            <!-- Document Metadata -->
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                @if($document->file_size)
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2M7 4h10M7 4l-2 14h14l-2-14"></path>
                                        </svg>
                                        {{ $document->getFileSizeFormatted() }}
                                    </span>
                                @endif
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Securizat
                                </span>
                            </div>

                            <!-- Download Button -->
                            <a href="{{ $document->getFileUrl() }}" 
                               target="_blank"
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 group-hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Descarcă Document
                            </a>
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

@endsection

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
