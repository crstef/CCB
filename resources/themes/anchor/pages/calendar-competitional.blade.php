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
                                    $currentDate = now()->create($currentYear, $currentMonth, $day);
                                    $dateString = $currentDate->format('Y-m-d');
                                    $dayEvents = $currentMonthEvents->get($dateString, collect());
                                    $isToday = $currentDate->isToday();
                                    $isPast = $currentDate->isPast();
                                    $isFuture = $currentDate->isFuture();
                                    
                                    // Determine event status if there are events
                                    $eventStatus = null;
                                    $firstEvent = $dayEvents->first();
                                    if ($firstEvent) {
                                        $eventStart = \Carbon\Carbon::parse($firstEvent->event_start_date);
                                        $eventEnd = $firstEvent->event_end_date ? \Carbon\Carbon::parse($firstEvent->event_end_date) : $eventStart;
                                        
                                        if (now()->between($eventStart, $eventEnd->endOfDay())) {
                                            $eventStatus = 'ongoing'; // în curs
                                        } elseif (now()->isAfter($eventEnd->endOfDay())) {
                                            $eventStatus = 'finished'; // terminat
                                        } else {
                                            $eventStatus = 'upcoming'; // viitor
                                        }
                                    }
                                @endphp
                                
                                @if($dayEvents->count() > 0)
                                    <a href="{{ $firstEvent->link() }}" 
                                       class="h-10 flex items-center justify-center text-sm relative rounded font-semibold transition-all duration-200
                                        @if($isToday) 
                                            bg-blue-600 text-white shadow-lg
                                        @elseif($eventStatus === 'finished')
                                            bg-gray-400 text-white hover:bg-gray-500
                                        @elseif($eventStatus === 'ongoing')
                                            bg-green-500 text-white hover:bg-green-600 shadow-md
                                        @else
                                            bg-blue-400 text-white hover:bg-blue-500 shadow-md
                                        @endif"
                                       title="{{ $firstEvent->title }} - Click pentru detalii">
                                        {{ $day }}
                                        <div class="absolute -top-1 -right-1 w-3 h-3 
                                            @if($eventStatus === 'finished') bg-gray-600
                                            @elseif($eventStatus === 'ongoing') bg-green-600 animate-pulse
                                            @else bg-blue-600
                                            @endif rounded-full border border-white"></div>
                                    </a>
                                @else
                                    <div class="h-10 flex items-center justify-center text-sm relative rounded
                                        @if($isToday) 
                                            bg-blue-600 text-white font-bold
                                        @else 
                                            @if($isPast) text-gray-400 @else text-gray-700 @endif hover:bg-gray-100
                                        @endif">
                                        {{ $day }}
                                    </div>
                                @endif
                            @endfor
                        </div>
                        
                        <!-- Legend -->
                        <div class="mt-4 flex justify-center flex-wrap gap-3 text-xs text-gray-600">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-600 rounded mr-1"></div>
                                <span>Astăzi</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-400 rounded mr-1"></div>
                                <span>Competiții viitoare</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded mr-1"></div>
                                <span>În curs de desfășurare</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gray-400 rounded mr-1"></div>
                                <span>Competiții terminate</span>
                            </div>
                        </div>
                        <div class="mt-2 text-center text-xs text-gray-500">
                            💡 Click pe zilele cu competiții pentru a vedea detaliile
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
                        
                        <!-- Calendar Navigation Link -->
                        <div class="text-center mt-4 pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600 font-medium">
                                📅 Vezi toate evenimentele în calendarul de mai sus
                            </p>
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