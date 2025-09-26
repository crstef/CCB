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

            <!-- Calendar Table -->
            <div class="bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                <table class="w-full">
                    <thead>
                        <tr class="bg-blue-600">
                            @foreach(['Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie'] as $monthName)
                                <th class="px-2 py-3 text-white text-sm font-semibold text-center border-r border-blue-500 last:border-r-0">
                                    {{ $monthName }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for($day = 1; $day <= 31; $day++)
                            <tr class="border-b border-gray-200">
                                <td class="px-1 py-1 text-xs text-center border-r border-gray-200 w-12">
                                    <div class="font-bold">{{ $day }}</div>
                                    @php
                                        $date = now()->create($currentYear, 3, $day);
                                        if ($date->month == 3) {
                                            echo '<div class="text-gray-500">' . $dayNames[$date->dayOfWeek] . '</div>';
                                        }
                                    @endphp
                                </td>
                                @foreach([3, 4, 5, 6, 7, 8, 9, 10, 11] as $month)
                                    <td class="px-1 py-1 text-xs border-r border-gray-200 last:border-r-0 h-8">
                                        @php
                                            $date = now()->create($currentYear, $month, 1);
                                            if ($day <= $date->daysInMonth) {
                                                $dateString = now()->create($currentYear, $month, $day)->format('Y-m-d');
                                                $dayEvents = $events->get($dateString, collect());
                                                $dayName = $dayNames[now()->create($currentYear, $month, $day)->dayOfWeek];
                                                
                                                if ($dayEvents->count() > 0) {
                                                    $event = $dayEvents->first();
                                                    $isPast = now()->create($currentYear, $month, $day)->lt(now()->startOfDay());
                                                    $isToday = now()->create($currentYear, $month, $day)->isToday();
                                                    
                                                    if ($isToday) {
                                                        $colorClass = 'bg-green-500';
                                                    } elseif ($isPast) {
                                                        $colorClass = 'bg-gray-400';
                                                    } else {
                                                        $colorClass = 'bg-blue-500';
                                                    }
                                                    
                                                    echo '<div class="' . $colorClass . ' text-white px-1 rounded text-center cursor-pointer hover:opacity-75" 
                                                          onclick="showEventPopup(\'' . htmlspecialchars($event->title, ENT_QUOTES) . '\', \'' . $event->slug . '\')">' . 
                                                          $dayName . '</div>';
                                                } else {
                                                    echo '<div class="text-gray-400 text-center">' . $dayName . '</div>';
                                                }
                                            }
                                        @endphp
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            
            <!-- Legend -->
            <div class="flex justify-center gap-6 mt-4 text-sm">
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
                    <span>Evenimente trecute</span>
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

    <!-- Event Popup Modal -->
    <div id="eventPopup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 id="popupTitle" class="text-lg font-semibold text-gray-900 pr-4"></h3>
                <button onclick="closeEventPopup()" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="flex gap-3">
                <button onclick="viewEventDetails()" 
                        class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Vezi Detalii
                </button>
                <button onclick="closeEventPopup()" 
                        class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                    Închide
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentEventSlug = '';
        
        function showEventPopup(title, slug) {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('eventPopup').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            currentEventSlug = slug;
        }
        
        function closeEventPopup() {
            document.getElementById('eventPopup').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function viewEventDetails() {
            window.open('/evenimente/' + currentEventSlug, '_blank');
        }
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEventPopup();
            }
        });
        
        // Close when clicking outside
        document.getElementById('eventPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEventPopup();
            }
        });
    </script>
</x-layouts.marketing>