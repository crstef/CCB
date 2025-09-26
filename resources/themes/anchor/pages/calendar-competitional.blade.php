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
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Premium Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent mb-4">
                    Calendar Competițional {{ $currentYear }}
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Descoperă toate evenimentele și competițiile din acest an într-un design elegant și intuitiv
                </p>
            </div>

            <!-- Modern Premium Calendar -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="grid grid-cols-10 gap-4">
                        <div class="text-white font-semibold text-sm text-center">Ziua</div>
                        @foreach(['Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov'] as $monthName)
                            <div class="text-white font-semibold text-sm text-center">{{ $monthName }}</div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Calendar Body -->
                <div class="p-4 space-y-2">
                    @for($day = 1; $day <= 31; $day++)
                        <div class="grid grid-cols-10 gap-4 items-center">
                            <!-- Day number column -->
                            <div class="text-center py-3">
                                <div class="font-bold text-lg text-gray-800">{{ $day }}</div>
                                @php
                                    $date = now()->create($currentYear, 3, $day);
                                    if ($date->month == 3 && $day <= $date->daysInMonth) {
                                        echo '<div class="text-xs text-gray-500 mt-1">' . $dayNames[$date->dayOfWeek] . '</div>';
                                    }
                                @endphp
                            </div>
                            
                            <!-- Month columns -->
                            @foreach([3, 4, 5, 6, 7, 8, 9, 10, 11] as $month)
                                <div class="min-h-[60px] flex items-center justify-center p-2">
                                    @php
                                        $date = now()->create($currentYear, $month, 1);
                                        if ($day <= $date->daysInMonth) {
                                            $dateString = now()->create($currentYear, $month, $day)->format('Y-m-d');
                                            $dayEvents = $events->get($dateString, collect());
                                            
                                            if ($dayEvents->count() > 0) {
                                                $event = $dayEvents->first();
                                                $eventDate = now()->create($currentYear, $month, $day);
                                                $isPast = $eventDate->lt(now()->startOfDay());
                                                $isToday = $eventDate->isToday();
                                                
                                                // Design premium cu gradient și shadow
                                                if ($isToday) {
                                                    $classes = 'bg-gradient-to-br from-green-500 to-green-600 text-white shadow-lg shadow-green-200 border-2 border-green-400';
                                                    $hoverClasses = 'hover:from-green-600 hover:to-green-700 hover:shadow-xl hover:shadow-green-300';
                                                } elseif ($isPast) {
                                                    $classes = 'bg-gradient-to-br from-gray-400 to-gray-500 text-white shadow-md shadow-gray-200 border border-gray-300';
                                                    $hoverClasses = 'hover:from-gray-500 hover:to-gray-600 hover:shadow-lg';
                                                } else {
                                                    $classes = 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-200 border-2 border-blue-400';
                                                    $hoverClasses = 'hover:from-blue-600 hover:to-blue-700 hover:shadow-xl hover:shadow-blue-300';
                                                }
                                                
                                                echo '<div class="' . $classes . ' ' . $hoverClasses . ' rounded-xl p-3 cursor-pointer transform transition-all duration-300 hover:scale-105 hover:-translate-y-1 w-full" 
                                                          onclick="window.open(\'/evenimente/' . $event->slug . '\', \'_blank\')"
                                                          title="Click pentru detalii">';
                                                echo '<div class="text-xs font-semibold text-center leading-tight">' . 
                                                     htmlspecialchars(Str::limit($event->title, 25)) . '</div>';
                                                
                                                // Status indicator
                                                if ($isToday) {
                                                    echo '<div class="text-center mt-2"><div class="inline-block w-2 h-2 bg-white rounded-full animate-pulse"></div></div>';
                                                }
                                                
                                                echo '</div>';
                                            } else {
                                                // Empty state cu stil elegant
                                                echo '<div class="w-full h-12 rounded-lg bg-gray-50 border border-gray-100 hover:bg-gray-100 transition-colors duration-200"></div>';
                                            }
                                        }
                                    @endphp
                                </div>
                            @endforeach
                        </div>
                        
                        @if($day < 31)
                            <div class="border-b border-gray-100"></div>
                        @endif
                    @endfor
                </div>
            </div>
            
            <!-- Premium Legend -->
            <div class="flex flex-wrap justify-center gap-8 mt-8 p-6 bg-gray-50 rounded-2xl">
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg shadow-blue-200 border-2 border-blue-400"></div>
                    <span class="text-gray-700 font-medium">Evenimente viitoare</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg shadow-green-200 border-2 border-green-400 relative">
                        <div class="absolute inset-2 bg-white rounded-full animate-pulse"></div>
                    </div>
                    <span class="text-gray-700 font-medium">Evenimente astăzi</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-gradient-to-br from-gray-400 to-gray-500 rounded-lg shadow-md shadow-gray-200 border border-gray-300"></div>
                    <span class="text-gray-700 font-medium">Evenimente trecute</span>
                </div>
            </div>
            
            <!-- Premium Back Button -->
            <div class="text-center mt-10">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl shadow-lg shadow-blue-200 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl hover:shadow-blue-300 transform hover:scale-105 transition-all duration-300 border-2 border-blue-500">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>