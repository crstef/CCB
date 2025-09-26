<?php
    use function Laravel\Folio\{name};
    name('calendar-competitional');

    // Get all upcoming events
    $upcomingEvents = \Wave\Event::where('status', 'PUBLISHED')
        ->where('event_start_date', '>=', now())
        ->orderBy('event_start_date', 'asc')
        ->paginate(9);
    
    // Get past events for history section
    $pastEvents = \Wave\Event::where('status', 'PUBLISHED')
        ->where('event_start_date', '<', now())
        ->orderBy('event_start_date', 'desc')
        ->limit(6)
        ->get();

    $seo = [
        'seo_title' => 'Calendar Competițional - Club Chinologic București Otopeni',
        'seo_description' => 'Calendarul competițional al Clubului Chinologic București Otopeni. Găsește toate evenimentele, concursurile și competițiile planificate.',
    ];
?>

<x-layouts.marketing :seo="$seo">
    <div class="bg-white">
        <!-- Header Section -->
        <div class="relative bg-gradient-to-br from-blue-600 to-indigo-700 py-16 sm:py-20">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Calendar Competițional
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-xl text-blue-100 leading-relaxed">
                        Toate evenimentele, concursurile și competițiile organizate de Clubul Chinologic București Otopeni
                    </p>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Upcoming Events Section -->
            @if($upcomingEvents->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">
                            Evenimente Viitoare
                        </h2>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $upcomingEvents->total() }} {{ $upcomingEvents->total() == 1 ? 'eveniment' : 'evenimente' }}
                        </div>
                    </div>

                    <!-- Events Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($upcomingEvents as $event)
                            <div class="bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-xl hover:border-blue-200 transition-all duration-300 group cursor-pointer overflow-hidden"
                                 onclick="window.open('{{ $event->link() }}', '_blank')">
                                
                                <!-- Event Image -->
                                @if($event->image)
                                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 overflow-hidden">
                                        <img src="{{ $event->image() }}" alt="{{ $event->title }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="h-48 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <!-- Event Date Badge -->
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            <div class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-bold">
                                                {{ $event->event_start_date->format('d') }}
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                {{ $event->event_start_date->format('M Y') }}
                                            </div>
                                        </div>
                                        @if($event->booking_end_date && $event->booking_end_date > now())
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">
                                                Înscrieri deschise
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Event Title -->
                                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 mb-2">
                                        {{ $event->title }}
                                    </h3>

                                    <!-- Event Location -->
                                    @if($event->location)
                                        <p class="text-sm text-gray-600 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $event->location }}
                                        </p>
                                    @endif

                                    <!-- Disciplines -->
                                    @if($event->disciplines && count($event->disciplines) > 0)
                                        <div class="flex flex-wrap gap-1 mb-3">
                                            @foreach(array_slice($event->disciplines, 0, 3) as $discipline)
                                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                                    {{ $discipline }}
                                                </span>
                                            @endforeach
                                            @if(count($event->disciplines) > 3)
                                                <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                                                    +{{ count($event->disciplines) - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Event Description Preview -->
                                    @if($event->excerpt)
                                        <p class="text-sm text-gray-600 line-clamp-2">
                                            {{ Str::limit($event->excerpt, 100) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Hover effect overlay -->
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 to-indigo-500/0 group-hover:from-blue-500/5 group-hover:to-indigo-500/5 transition-all duration-300 opacity-0 group-hover:opacity-100 pointer-events-none"></div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($upcomingEvents->hasPages())
                        <div class="flex justify-center">
                            {{ $upcomingEvents->links() }}
                        </div>
                    @endif
                </div>
            @else
                <!-- No Upcoming Events -->
                <div class="text-center py-16 bg-gray-50 rounded-2xl mb-16">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-900 mt-6">Nu există evenimente planificate</h3>
                    <p class="mt-2 text-lg text-gray-600 max-w-md mx-auto">
                        În acest moment nu avem evenimente programate. Te rugăm să revii pentru actualizări.
                    </p>
                </div>
            @endif

            <!-- Past Events Section -->
            @if($pastEvents->count() > 0)
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">
                        Evenimente Recente
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pastEvents as $event)
                            <div class="bg-gray-50 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:bg-white transition-all duration-300 group cursor-pointer overflow-hidden opacity-75 hover:opacity-100"
                                 onclick="window.open('{{ $event->link() }}', '_blank')">
                                
                                @if($event->image)
                                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 overflow-hidden">
                                        <img src="{{ $event->image() }}" alt="{{ $event->title }}" 
                                             class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300 filter grayscale group-hover:grayscale-0">
                                    </div>
                                @else
                                    <div class="h-32 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="bg-gray-400 text-white px-2 py-1 rounded text-xs font-bold">
                                                {{ $event->event_start_date->format('d') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $event->event_start_date->format('M Y') }}
                                            </div>
                                        </div>
                                        <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">
                                            Finalizat
                                        </span>
                                    </div>

                                    <h3 class="text-sm font-semibold text-gray-700 group-hover:text-gray-900 transition-colors duration-200 mb-1">
                                        {{ $event->title }}
                                    </h3>

                                    @if($event->location)
                                        <p class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            </svg>
                                            {{ $event->location }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.marketing>