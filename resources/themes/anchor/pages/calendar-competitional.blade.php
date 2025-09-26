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
                                
                                <div class="h-12 border-r border-b border-gray-100 p-1 relative
                                    @if($isToday) bg-green-50 border-green-200 
                                    @elseif($dayEvents->count() > 0 && $isPast) bg-gray-100
                                    @elseif($dayEvents->count() > 0) bg-blue-50 border-blue-200
                                    @else hover:bg-gray-50
                                    @endif">
                                    
                                    <!-- Day Number -->
                                    <div class="text-xs font-medium 
                                        @if($isToday) text-green-700
                                        @elseif($dayEvents->count() > 0 && $isPast) text-gray-500
                                        @elseif($dayEvents->count() > 0) text-blue-700
                                        @else text-gray-700
                                        @endif">
                                        {{ $day }}
                                    </div>
                                    
                                    <!-- Event Indicator/Title -->
                                    @if($dayEvents->count() > 0)
                                        @php $event = $dayEvents->first(); @endphp
                                        <div class="absolute inset-x-1 bottom-0 cursor-pointer"
                                             onclick="showEventDetails('{{ htmlspecialchars($event->title, ENT_QUOTES) }}', '{{ $event->slug }}', '{{ $dateString }}')">
                                            <div class="text-[9px] leading-tight font-medium truncate
                                                @if($isToday) text-green-800
                                                @elseif($isPast) text-gray-600
                                                @else text-blue-800
                                                @endif">
                                                {{ Str::limit($event->title, 12) }}
                                            </div>
                                            
                                            @if($dayEvents->count() > 1)
                                                <div class="text-[8px] text-gray-500">
                                                    +{{ $dayEvents->count() - 1 }} mai multe
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
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

    <!-- Event Details Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 mb-2"></h3>
                        <p id="modalDate" class="text-sm text-gray-600"></p>
                    </div>
                    <button onclick="closeEventModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex gap-3 mt-6">
                    <button onclick="viewEvent()" 
                            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Vezi Detalii
                    </button>
                    <button onclick="closeEventModal()" 
                            class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
                        Închide
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentEventSlug = '';
        
        function showEventDetails(title, slug, date) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDate').textContent = new Date(date).toLocaleDateString('ro-RO', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('eventModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            currentEventSlug = slug;
        }
        
        function closeEventModal() {
            document.getElementById('eventModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function viewEvent() {
            window.open('/evenimente/' + currentEventSlug, '_blank');
        }
        
        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEventModal();
            }
        });
        
        // Close when clicking outside
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEventModal();
            }
        });
    </script>
</x-layouts.marketing>