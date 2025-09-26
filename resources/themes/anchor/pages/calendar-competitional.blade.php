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
                                
                                <div class="h-14 border-r border-b border-gray-100 p-1 relative
                                    @if($isToday) bg-green-50 border-green-200 
                                    @elseif($dayEvents->count() > 0 && $isPast) bg-gray-50
                                    @elseif($dayEvents->count() > 0) bg-blue-50 border-blue-200
                                    @else hover:bg-gray-50
                                    @endif">
                                    
                                    <!-- Day Number -->
                                    <div class="text-xs text-gray-600 mb-1">{{ $day }}</div>
                                    
                                    @if($dayEvents->count() > 0)
                                        @php $event = $dayEvents->first(); @endphp
                                        <!-- Event Badge -->
                                        <div class="event-item cursor-pointer relative"
                                             onclick="window.open('/evenimente/{{ $event->slug }}', '_blank')"
                                             onmouseover="showHoverPopup(event, '{{ htmlspecialchars($event->title, ENT_QUOTES) }}', '{{ htmlspecialchars($event->location ?? 'Locația va fi anunțată', ENT_QUOTES) }}', '{{ $dateString }}')"
                                             onmouseout="hideHoverPopup()">
                                            
                                            <!-- Event Title Badge -->
                                            <div class="px-1 py-0.5 rounded text-[8px] leading-tight truncate
                                                @if($isToday) bg-green-100 text-green-800 border border-green-200
                                                @elseif($isPast) bg-gray-100 text-gray-600 border border-gray-200
                                                @else bg-blue-100 text-blue-800 border border-blue-200
                                                @endif">
                                                {{ Str::limit($event->title, 18) }}
                                            </div>
                                            
                                            <!-- Multiple Events Dot -->
                                            @if($dayEvents->count() > 1)
                                                <div class="absolute -top-1 -right-1 w-2 h-2 bg-orange-400 rounded-full"></div>
                                            @endif
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
                    <div class="w-4 h-4 bg-blue-50 border border-blue-200 rounded mr-2"></div>
                    <span>Evenimente viitoare</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-50 border border-green-200 rounded mr-2"></div>
                    <span>Astăzi</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-gray-100 border border-gray-200 rounded mr-2"></div>
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

    <!-- Hover Popup -->
    <div id="hoverPopup" class="fixed bg-white border border-gray-300 rounded-lg shadow-lg p-3 z-50 hidden max-w-xs">
        <div class="text-sm font-medium text-gray-900 mb-1" id="popupTitle"></div>
        <div class="text-xs text-gray-600 mb-1" id="popupLocation"></div>
        <div class="text-xs text-gray-500" id="popupDate"></div>
        <div class="text-xs text-blue-600 mt-2">Click pentru detalii complete</div>
    </div>

    <script>
        let popupTimeout;
        
        function showHoverPopup(event, title, location, date) {
            clearTimeout(popupTimeout);
            const popup = document.getElementById('hoverPopup');
            
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('popupLocation').textContent = location;
            document.getElementById('popupDate').textContent = new Date(date).toLocaleDateString('ro-RO', {
                weekday: 'long',
                day: 'numeric',
                month: 'long'
            });
            
            // Position popup near mouse
            const rect = event.target.getBoundingClientRect();
            popup.style.left = (rect.left + window.scrollX + 10) + 'px';
            popup.style.top = (rect.top + window.scrollY - 10) + 'px';
            
            popup.classList.remove('hidden');
        }
        
        function hideHoverPopup() {
            popupTimeout = setTimeout(() => {
                document.getElementById('hoverPopup').classList.add('hidden');
            }, 100);
        }
    </script>
</x-layouts.marketing>