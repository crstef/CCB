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

            <!-- Calendar Grid -->
            <div class="bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                <!-- Header cu lunile -->
                <div class="grid grid-cols-10 bg-blue-600">
                    <div class="p-3 text-white text-sm font-semibold text-center border-r border-blue-500">
                        Ziua
                    </div>
                    @foreach(['Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie'] as $monthName)
                        <div class="p-3 text-white text-sm font-semibold text-center border-r border-blue-500 last:border-r-0">
                            {{ $monthName }}
                        </div>
                    @endforeach
                </div>
                
                <!-- Calendar days -->
                @for($day = 1; $day <= 31; $day++)
                    <div class="grid grid-cols-10 border-b border-gray-200 min-h-[60px]">
                        <!-- Coloana cu ziua -->
                        <div class="p-2 border-r border-gray-200 bg-gray-50 flex flex-col items-center justify-center">
                            <div class="font-bold text-sm">{{ $day }}</div>
                            @php
                                $date = now()->create($currentYear, 3, $day);
                                if ($date->month == 3 && $day <= $date->daysInMonth) {
                                    echo '<div class="text-gray-500 text-xs">' . $dayNames[$date->dayOfWeek] . '</div>';
                                }
                            @endphp
                        </div>
                        
                        <!-- Celule pentru fiecare lună -->
                        @foreach([3, 4, 5, 6, 7, 8, 9, 10, 11] as $month)
                            <div class="p-1 border-r border-gray-200 last:border-r-0 relative">
                                @php
                                    $date = now()->create($currentYear, $month, 1);
                                    if ($day <= $date->daysInMonth) {
                                        $dateString = now()->create($currentYear, $month, $day)->format('Y-m-d');
                                        $dayEvents = $events->get($dateString, collect());
                                        
                                        if ($dayEvents->count() > 0) {
                                            $event = $dayEvents->first();
                                            $isPast = now()->create($currentYear, $month, $day)->lt(now()->startOfDay());
                                            $isToday = now()->create($currentYear, $month, $day)->isToday();
                                            
                                            // Determinăm culoarea
                                            if ($isToday) {
                                                $bgColor = 'bg-green-500';
                                                $textColor = 'text-white';
                                                $borderColor = 'border-green-600';
                                            } elseif ($isPast) {
                                                $bgColor = 'bg-gray-400';
                                                $textColor = 'text-white';
                                                $borderColor = 'border-gray-500';
                                            } else {
                                                $bgColor = 'bg-blue-500';
                                                $textColor = 'text-white';
                                                $borderColor = 'border-blue-600';
                                            }
                                            
                                            // Afișăm badge-ul cu titlul evenimentului
                                            echo '<div class="' . $bgColor . ' ' . $textColor . ' ' . $borderColor . ' rounded-md p-1 text-xs font-medium cursor-pointer hover:scale-105 transition-all duration-200 border-2 shadow-sm" 
                                                      onclick="window.open(\'/evenimente/' . $event->slug . '\', \'_blank\')"
                                                      title="Click pentru detalii">' . 
                                                      htmlspecialchars(Str::limit($event->title, 20)) . '</div>';
                                        }
                                    }
                                @endphp
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>
            
            <!-- Legend -->
            <div class="flex flex-wrap justify-center gap-6 mt-6 text-sm">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                    <span>Evenimente viitoare</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span>Evenimente astăzi</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-gray-400 rounded mr-2"></div>
                    <span>evenimente trecute</span>
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>