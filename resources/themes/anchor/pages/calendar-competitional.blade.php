<?php

use Wave\Event;
use function Laravel\Folio\name;
use Illuminate\Support\Str;

name('calendar-competitional');

// Get current year and events
$currentYear = now()->year;
$events = Event::where('status', 'PUBLISHED')
    ->whereYear('event_start_date', $currentYear)
    ->get()
    ->groupBy(function($event) {
        return $event->event_start_date->format('Y-m-d');
    });

// Day names mapping (0 = Sunday, 1 = Monday, etc.)
$dayNames = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];

// SEO configuration
$seo = (object) [
    'title' => 'Calendar Competițional ' . $currentYear . ' - CCB',
    'description' => 'Calendarul competițional pentru anul ' . $currentYear . ' cu toate evenimentele și concursurile planificate.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ $currentYear }} Calendar Competițional - CCB
                </h1>
            </div>

            <!-- Calendar Grid - 12 luni -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @for($month = 1; $month <= 12; $month++)
                    @php
                        $firstDay = now()->create($currentYear, $month, 1);
                        $daysInMonth = $firstDay->daysInMonth;
                        $startDayOfWeek = $firstDay->dayOfWeek; // 0=Sunday, 1=Monday, etc.
                        $monthName = $firstDay->format('F');
                        $monthNameRo = [
                            'January' => 'Ianuarie', 'February' => 'Februarie', 'March' => 'Martie',
                            'April' => 'Aprilie', 'May' => 'Mai', 'June' => 'Iunie',
                            'July' => 'Iulie', 'August' => 'August', 'September' => 'Septembrie',
                            'October' => 'Octombrie', 'November' => 'Noiembrie', 'December' => 'Decembrie'
                        ][$monthName];
                    @endphp
                    
                    <div class="bg-white rounded-lg shadow border overflow-hidden">
                        <!-- Month Header -->
                        <div class="bg-blue-600 text-white p-3 text-center">
                            <h3 class="font-semibold text-lg">{{ $monthNameRo }}</h3>
                        </div>
                        
                        <!-- Days Header -->
                        <div class="grid grid-cols-7 bg-gray-100 text-xs font-semibold text-gray-600">
                            <div class="p-2 text-center">D</div>
                            <div class="p-2 text-center">L</div>
                            <div class="p-2 text-center">M</div>
                            <div class="p-2 text-center">M</div>
                            <div class="p-2 text-center">J</div>
                            <div class="p-2 text-center">V</div>
                            <div class="p-2 text-center">S</div>
                        </div>
                        
                        <!-- Calendar Days -->
                        <div class="grid grid-cols-7">
                            {{-- Empty cells pentru început de lună --}}
                            @for($i = 0; $i < $startDayOfWeek; $i++)
                                <div class="h-12 bg-gray-50"></div>
                            @endfor
                            
                            {{-- Zilele lunii --}}
                            @for($day = 1; $day <= $daysInMonth; $day++)
                                @php
                                    $dateString = now()->create($currentYear, $month, $day)->format('Y-m-d');
                                    $dayEvents = $events->get($dateString, collect());
                                    $isToday = now()->create($currentYear, $month, $day)->isToday();
                                    $isPast = now()->create($currentYear, $month, $day)->isPast();
                                @endphp
                                
                                <div class="h-12 border-r border-b border-gray-200 p-1 relative
                                    @if($dayEvents->count() > 0)
                                        @if($isToday) bg-green-500 text-white
                                        @elseif($isPast) bg-gray-400 text-white  
                                        @else bg-blue-500 text-white
                                        @endif
                                    @else bg-white hover:bg-gray-50
                                    @endif"
                                    @if($dayEvents->count() > 0)
                                        @php $event = $dayEvents->first(); @endphp
                                        onmouseover="showCellPopup(this, '{{ htmlspecialchars($event->title, ENT_QUOTES) }}', '{{ htmlspecialchars($event->location ?? 'Locația va fi anunțată', ENT_QUOTES) }}', '{{ $dateString }}', '{{ $event->slug }}')"
                                        onmouseout="hideCellPopup()"
                                        onclick="showEventDetails('{{ htmlspecialchars($event->title, ENT_QUOTES) }}', '{{ htmlspecialchars($event->location ?? 'Locația va fi anunțată', ENT_QUOTES) }}', '{{ $dateString }}', '{{ $event->slug }}')"
                                        class="cursor-pointer"
                                    @endif>
                                    
                                    <!-- Day Number -->
                                    <div class="text-xs font-medium 
                                        @if($dayEvents->count() > 0) text-white 
                                        @else text-gray-700 
                                        @endif">
                                        {{ $day }}
                                    </div>
                                    
                                    @if($dayEvents->count() > 1)
                                        <!-- Multiple Events Indicator -->
                                        <div class="absolute bottom-1 right-1 text-[8px] bg-white bg-opacity-30 rounded px-1 text-white">
                                            +{{ $dayEvents->count() - 1 }}
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
            
            <!-- Legend -->
            <div class="flex justify-center gap-6 mt-8 text-sm">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                    <span>Evenimente viitoare</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span>În curs / Astăzi</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-gray-400 rounded mr-2"></div>
                    <span>Trecute</span>
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi
                </a>
            </div>
        </div>
    </div>

    <!-- Hover Popup Window -->
    <div id="hoverWindow" class="fixed bg-white border-2 border-gray-300 rounded-lg shadow-xl p-4 z-50 hidden max-w-sm">
        <div class="text-sm font-bold text-gray-900 mb-2" id="hoverTitle"></div>
        <div class="text-xs text-gray-600 flex items-center mb-1">
            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            </svg>
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