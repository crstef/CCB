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
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Calendar Competițional {{ $currentYear }}
                </h1>
                <p class="text-gray-600">Evenimente și competiții CCB</p>
            </div>

            <!-- Calendar -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header cu lunile -->
                <div class="bg-blue-600 text-white p-4">
                    <div class="grid grid-cols-10 gap-2 text-sm font-semibold text-center">
                        <div>Ziua</div>
                        <div>Mar</div>
                        <div>Apr</div>
                        <div>Mai</div>
                        <div>Iun</div>
                        <div>Iul</div>
                        <div>Aug</div>
                        <div>Sep</div>
                        <div>Oct</div>
                        <div>Nov</div>
                    </div>
                </div>
                
                <!-- Zilele -->
                <div class="p-4">
                    @for($day = 1; $day <= 31; $day++)
                        <div class="grid grid-cols-10 gap-2 py-2 border-b border-gray-100 items-center">
                            <!-- Ziua -->
                            <div class="text-center font-semibold text-gray-700">
                                {{ $day }}
                            </div>
                            
                            <!-- Lunile -->
                            @foreach([3, 4, 5, 6, 7, 8, 9, 10, 11] as $month)
                                <div class="text-center min-h-[40px] flex items-center justify-center">
                                    @if($day <= now()->create($currentYear, $month, 1)->daysInMonth)
                                        @php
                                            $dateString = now()->create($currentYear, $month, $day)->format('Y-m-d');
                                            $dayEvents = $events->get($dateString, collect());
                                        @endphp
                                        
                                        @if($dayEvents->count() > 0)
                                            @php
                                                $event = $dayEvents->first();
                                                $isPast = now()->create($currentYear, $month, $day)->isPast();
                                                $isToday = now()->create($currentYear, $month, $day)->isToday();
                                            @endphp
                                            
                                            <div class="px-2 py-1 rounded text-xs font-medium cursor-pointer hover:opacity-80
                                                @if($isToday) bg-green-500 text-white
                                                @elseif($isPast) bg-gray-400 text-white  
                                                @else bg-blue-500 text-white
                                                @endif"
                                                onclick="window.open('/evenimente/{{ $event->slug }}', '_blank')"
                                                title="{{ $event->title }}">
                                                {{ Str::limit($event->title, 15) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
            
            <!-- Legend -->
            <div class="flex justify-center gap-6 mt-6 text-sm">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                    <span>Viitoare</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span>Astăzi</span>
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
</x-layouts.marketing>