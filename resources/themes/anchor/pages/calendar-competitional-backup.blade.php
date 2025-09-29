<?php

use Wave\Event;
use function Laravel\Folio\name;
use Carbon\Carbon;

name('calendar-competitional');

// Get current year and events
$currentYear = now()->year;
$currentMonth = now()->month;

// Get upcoming events (next 3 months)
$upcomingEvents = Event::where('status', 'PUBLISHED')
    ->where('event_start_date', '>=', now()->startOfDay())
    ->orderBy('event_start_date', 'asc')
    ->take(10)
    ->get();

// Get past events (last 3 months, limited)
$pastEvents = Event::where('status', 'PUBLISHED')
    ->where('event_start_date', '<', now()->startOfDay())
    ->orderBy('event_start_date', 'desc')
    ->take(5)
    ->get();

// Get events for current month calendar
$currentMonthStart = now()->startOfMonth();
$currentMonthEvents = Event::where('status', 'PUBLISHED')
    ->whereBetween('event_start_date', [
        $currentMonthStart,
        $currentMonthStart->copy()->endOfMonth()
    ])
    ->get()
    ->groupBy(function($event) {
        return $event->event_start_date->format('Y-m-d');
    });

// Calendar data for current month
$firstDay = $currentMonthStart->copy();
$daysInMonth = $firstDay->daysInMonth;
$startDayOfWeek = $firstDay->dayOfWeek;
$monthName = $firstDay->format('F');
$monthNameRo = [
    'January' => 'Ianuarie', 'February' => 'Februarie', 'March' => 'Martie',
    'April' => 'Aprilie', 'May' => 'Mai', 'June' => 'Iunie',
    'July' => 'Iulie', 'August' => 'August', 'September' => 'Septembrie',
    'October' => 'Octombrie', 'November' => 'Noiembrie', 'December' => 'Decembrie'
][$monthName];

// SEO configuration
$seo = (object) [
    'title' => 'Calendar Competițional ' . $currentYear . ' - CCB',
    'description' => 'Calendarul competițional pentru anul ' . $currentYear . ' cu toate evenimentele și concursurile planificate.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Calendar Competițional {{ $currentYear }}
                </h1>
                <p class="text-gray-600">
                    Planifică-ți participarea la competițiile și evenimentele CCB
                </p>
            </div>

            <!-- Main Layout: Calendar + Events List -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                
                <!-- Current Month Calendar -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4">
                        <h2 class="text-xl font-semibold text-center">{{ $monthNameRo }} {{ $currentYear }}</h2>
                    </div>
                    
                    <!-- Calendar Grid -->
                    <div class="p-4">
                        <!-- Days Header -->
                        <div class="grid grid-cols-7 gap-1 mb-2">
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">D</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">L</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">M</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">M</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">J</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">V</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">S</div>
                        </div>
                        
                        <!-- Calendar Days -->
                        <div class="grid grid-cols-7 gap-1">
                            {{-- Empty cells pentru început de lună --}}
                            @for($i = 0; $i < $startDayOfWeek; $i++)
                                <div class="h-10"></div>
                            @endfor
                            
                            {{-- Zilele lunii --}}
                            @for($day = 1; $day <= $daysInMonth; $day++)
                                @php
                                    $dateString = now()->create($currentYear, $currentMonth, $day)->format('Y-m-d');
                                    $dayEvents = $currentMonthEvents->get($dateString, collect());
                                    $isToday = now()->create($currentYear, $currentMonth, $day)->isToday();
                                    $isPast = now()->create($currentYear, $currentMonth, $day)->isPast();
                                @endphp
                                
                                <div class="h-10 flex items-center justify-center text-sm relative rounded
                                    @if($isToday) 
                                        bg-blue-600 text-white font-bold
                                    @elseif($dayEvents->count() > 0)
                                        @if($isPast) bg-gray-300 text-gray-600
                                        @else bg-green-100 text-green-800 font-semibold cursor-pointer hover:bg-green-200
                                        @endif
                                    @else 
                                        @if($isPast) text-gray-400 @else text-gray-700 @endif hover:bg-gray-100
                                    @endif"
                                    @if($dayEvents->count() > 0 && !$isPast)
                                        title="{{ $dayEvents->first()->title }}"
                                    @endif>
                                    {{ $day }}
                                    @if($dayEvents->count() > 0)
                                        <div class="absolute bottom-0 right-0 w-2 h-2 bg-red-500 rounded-full"></div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                        
                        <!-- Legend -->
                        <div class="mt-4 flex justify-center gap-4 text-xs text-gray-600">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-600 rounded mr-1"></div>
                                <span>Astăzi</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-100 border border-green-300 rounded mr-1"></div>
                                <span>Competiții</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events List -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-4">
                        <h2 class="text-xl font-semibold">Următoarele Competiții</h2>
                    </div>
                    
                    <div class="p-4 max-h-96 overflow-y-auto">
                        @if($upcomingEvents->count() > 0)
                            @foreach($upcomingEvents as $event)
                                @php
                                    $eventDate = Carbon::parse($event->event_start_date);
                                    $daysUntil = now()->diffInDays($eventDate, false);
                                @endphp
                                <div class="border-b border-gray-200 last:border-b-0 py-3">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900 mb-1">{{ $event->title }}</h3>
                                            <div class="flex items-center text-sm text-gray-600 mb-1">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $eventDate->format('d.m.Y') }}
                                            </div>
                                            @if($event->location)
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    </svg>
                                                    {{ $event->location }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4 text-right">
                                            @if($daysUntil == 0)
                                                <span class="inline-block px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">ASTĂZI</span>
                                            @elseif($daysUntil == 1)
                                                <span class="inline-block px-2 py-1 bg-orange-100 text-orange-800 text-xs font-semibold rounded">MÂINE</span>
                                            @else
                                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded">{{ $daysUntil }} ZILE</span>
                                            @endif
                                            <div class="mt-1">
                                                <a href="{{ $event->link() }}" class="text-xs text-blue-600 hover:text-blue-800">Detalii →</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p>Nu sunt competiții programate în perioada următoare.</p>
                            </div>
                        @endif
                        
                        <!-- View All Events Link -->
                        <div class="text-center mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('evenimente.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Vezi toate evenimentele
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Past Events Section -->
            @if($pastEvents->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 text-white p-4">
                        <h2 class="text-xl font-semibold">Competiții Recente</h2>
                    </div>
                    
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($pastEvents as $event)
                                @php
                                    $eventDate = Carbon::parse($event->event_start_date);
                                @endphp
                                <div class="border border-gray-200 rounded-lg p-3 opacity-75">
                                    <h3 class="font-semibold text-gray-700 mb-2">{{ $event->title }}</h3>
                                    <div class="flex items-center text-sm text-gray-500 mb-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $eventDate->format('d.m.Y') }}
                                    </div>
                                    @if($event->location)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    @endif
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">TERMINAT</span>
                                        <a href="{{ $event->link() }}" class="text-xs text-gray-500 hover:text-gray-700">Detalii →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>
            <span id="hoverLocationText"></span>
        </div>
        <div class="text-xs text-blue-600 mt-2 font-medium">Click pentru detalii complete</div>
    </div>

    <!-- Event Details Section (in same page) -->
    <div id="eventDetails" class="hidden mt-8 bg-white border border-gray-200 rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Detalii Eveniment</h3>
            <button onclick="hideEventDetails()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-2">Denumire Concurs</label>
                    <p id="detailsTitle" class="text-lg font-semibold text-gray-900"></p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-2">Locația</label>
                    <p id="detailsLocation" class="text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span id="detailsLocationText"></span>
                    </p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-2">Data și Ora</label>
                    <p id="detailsDate" class="text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span id="detailsDateText"></span>
                    </p>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-2">Status</label>
                    <div id="detailsStatus" class="flex items-center">
                        <div id="detailsStatusDot" class="w-3 h-3 rounded-full mr-2"></div>
                        <span id="detailsStatusText" class="text-sm font-medium"></span>
                    </div>
                </div>
                
                <div class="pt-4">
                    <button onclick="openEventPage()" 
                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Vezi Pagina Completă a Evenimentului
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentEventSlug = '';
        let hoverTimeout;
        let isMobile = window.innerWidth <= 768;
        
        // Detect mobile
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth <= 768;
        });
        
        function showCellPopup(cell, title, location, date, slug) {
            clearTimeout(hoverTimeout);
            
            const popup = document.getElementById('hoverWindow');
            const rect = cell.getBoundingClientRect();
            
            // Set content
            document.getElementById('hoverTitle').textContent = title;
            document.getElementById('hoverLocationText').textContent = location;
            
            // Position popup near the cell
            const left = rect.left + window.scrollX + rect.width + 10;
            const top = rect.top + window.scrollY;
            
            popup.style.left = left + 'px';
            popup.style.top = top + 'px';
            
            // Check if popup goes off screen and adjust
            setTimeout(() => {
                const popupRect = popup.getBoundingClientRect();
                if (popupRect.right > window.innerWidth) {
                    popup.style.left = (rect.left + window.scrollX - popup.offsetWidth - 10) + 'px';
                }
                if (popupRect.bottom > window.innerHeight) {
                    popup.style.top = (rect.top + window.scrollY - popup.offsetHeight + rect.height) + 'px';
                }
            }, 10);
            
            popup.classList.remove('hidden');
        }
        
        function hideCellPopup() {
            hoverTimeout = setTimeout(() => {
                document.getElementById('hoverWindow').classList.add('hidden');
            }, 300);
        }
        
        function showEventDetails(title, location, date, slug) {
            // Hide hover popup
            document.getElementById('hoverWindow').classList.add('hidden');
            
            // Set content
            document.getElementById('detailsTitle').textContent = title;
            document.getElementById('detailsLocationText').textContent = location;
            document.getElementById('detailsDateText').textContent = new Date(date).toLocaleDateString('ro-RO', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            
            // Set status
            const eventDate = new Date(date);
            const today = new Date();
            const dot = document.getElementById('detailsStatusDot');
            const statusText = document.getElementById('detailsStatusText');
            
            if (eventDate.toDateString() === today.toDateString()) {
                dot.className = 'w-3 h-3 rounded-full mr-2 bg-green-500';
                statusText.textContent = 'În desfășurare / Astăzi';
                statusText.className = 'text-sm font-medium text-green-700';
            } else if (eventDate < today) {
                dot.className = 'w-3 h-3 rounded-full mr-2 bg-gray-400';
                statusText.textContent = 'Eveniment trecut';
                statusText.className = 'text-sm font-medium text-gray-600';
            } else {
                dot.className = 'w-3 h-3 rounded-full mr-2 bg-blue-500';
                statusText.textContent = 'Eveniment viitor';
                statusText.className = 'text-sm font-medium text-blue-700';
            }
            
            currentEventSlug = slug;
            document.getElementById('eventDetails').classList.remove('hidden');
            
            // Scroll to details
            document.getElementById('eventDetails').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
        
        function hideEventDetails() {
            document.getElementById('eventDetails').classList.add('hidden');
        }
        
        function openEventPage() {
            window.open('/evenimente/' + currentEventSlug, '_blank');
        }
        
        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideEventDetails();
                hideCellPopup();
            }
        });
    </script>
</x-layouts.marketing>