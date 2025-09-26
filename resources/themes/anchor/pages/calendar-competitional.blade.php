<?php
    use function Laravel\Folio\{name};
    use Carbon\Carbon;
    
    name('calendar-competitional');

    // Get all events for the current year
    $currentYear = now()->year;
    $events = \Wave\Event::where('status', 'PUBLISHED')
        ->whereYear('event_start_date', $currentYear)
        ->get()
        ->groupBy(function($event) {
            return $event->event_start_date->format('Y-m-d');
        });

    // Helper arrays for Romanian month and day names
    $monthNames = [
        1 => 'Ianuarie', 2 => 'Februarie', 3 => 'Martie', 4 => 'Aprilie',
        5 => 'Mai', 6 => 'Iunie', 7 => 'Iulie', 8 => 'August',
        9 => 'Septembrie', 10 => 'Octombrie', 11 => 'Noiembrie', 12 => 'Decembrie'
    ];
    
    $dayNames = ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'];

    $seo = [
        'seo_title' => 'Calendar Competițional ' . $currentYear . ' - Club Chinologic București Otopeni',
        'seo_description' => 'Calendarul competițional al Clubului Chinologic București Otopeni pentru anul ' . $currentYear . '. Vezi toate evenimentele și concursurile planificate.',
    ];
?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Calendar Competițional {{ $currentYear }}
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Vezi toate evenimentele și concursurile planificate pentru anul în curs
                </p>
                
                <!-- Legend -->
                <div class="flex flex-wrap justify-center gap-6 mt-8 p-6 bg-white rounded-lg shadow-sm max-w-4xl mx-auto">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-300 rounded mr-2"></div>
                        <span class="text-sm text-gray-600">Trecut</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-600">Viitoare</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-600">Astăzi</span>
                    </div>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @for($month = 1; $month <= 12; $month++)
                    @php
                        $firstDay = Carbon::create($currentYear, $month, 1);
                        $lastDay = $firstDay->copy()->endOfMonth();
                        $startCalendar = $firstDay->copy()->startOfWeek(Carbon::SUNDAY);
                        $endCalendar = $lastDay->copy()->endOfWeek(Carbon::SATURDAY);
                        $today = now()->format('Y-m-d');
                    @endphp
                    
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Month Header -->
                        <div class="bg-blue-600 text-white p-4">
                            <h3 class="text-lg font-semibold text-center">
                                {{ $monthNames[$month] }}
                            </h3>
                        </div>
                        
                        <!-- Days of Week -->
                        <div class="grid grid-cols-7 bg-gray-100">
                            @for($i = 0; $i < 7; $i++)
                                <div class="p-2 text-center text-xs font-medium text-gray-600">
                                    {{ $dayNames[$i] }}
                                </div>
                            @endfor
                        </div>
                        
                        <!-- Calendar Days -->
                        <div class="grid grid-cols-7">
                            @php
                                $current = $startCalendar->copy();
                            @endphp
                            
                            @while($current <= $endCalendar)
                                @php
                                    $dateString = $current->format('Y-m-d');
                                    $isCurrentMonth = $current->month == $month;
                                    $dayEvents = $events->get($dateString, collect());
                                    $isPast = $current->lt(now()->startOfDay());
                                    $isToday = $dateString === $today;
                                    $isUpcoming = $current->gt(now()->startOfDay());
                                @endphp
                                
                                <div class="relative p-2 h-16 border border-gray-100 
                                    {{ !$isCurrentMonth ? 'bg-gray-50 text-gray-400' : 'bg-white' }}
                                    {{ $dayEvents->count() > 0 && $isCurrentMonth ? 'cursor-pointer transition-all duration-200 hover:shadow-md' : '' }}
                                    {{ $dayEvents->count() > 0 && $isCurrentMonth && $isToday ? 'bg-green-50 border-green-200 hover:bg-green-100' : '' }}
                                    {{ $dayEvents->count() > 0 && $isCurrentMonth && $isPast ? 'bg-gray-100 border-gray-200 hover:bg-gray-150' : '' }}
                                    {{ $dayEvents->count() > 0 && $isCurrentMonth && $isUpcoming ? 'bg-blue-50 border-blue-200 hover:bg-blue-100' : '' }}"
                                    @if($dayEvents->count() > 0 && $isCurrentMonth)
                                        data-tooltip="{{ $dayEvents->first()->title }}"
                                        data-date="{{ $current->format('d M Y') }}"
                                        onclick="goToEvent('{{ $dayEvents->first()->slug }}')"
                                        onmouseenter="showTooltip(this, {{ json_encode($dayEvents->map(function($event) {
                                            return [
                                                'title' => $event->title,
                                                'time' => $event->event_start_date->format('H:i'),
                                                'location' => $event->location
                                            ];
                                        })) }})"
                                        onmouseleave="hideTooltip()"
                                    @endif>
                                    
                                    <!-- Day Number -->
                                    <span class="text-sm {{ !$isCurrentMonth ? 'text-gray-400' : 'text-gray-900' }}">
                                        {{ $current->day }}
                                    </span>
                                    
                                    <!-- Event Indicator -->
                                    @if($dayEvents->count() > 0 && $isCurrentMonth)
                                        <div class="absolute bottom-1 left-1/2 transform -translate-x-1/2">
                                            @if($isToday)
                                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse shadow-lg"></div>
                                            @elseif($isPast)
                                                <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                                            @else
                                                <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce shadow-lg"></div>
                                            @endif
                                        </div>
                                        
                                        @if($dayEvents->count() > 1)
                                            <span class="absolute top-1 right-1 text-xs bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-bold shadow-md">
                                                {{ $dayEvents->count() }}
                                            </span>
                                        @endif
                                        
                                        <!-- Event title preview for larger screens -->
                                        <div class="absolute inset-x-1 bottom-4 hidden lg:block">
                                            <div class="text-[8px] text-center font-medium truncate
                                                {{ $isToday ? 'text-green-700' : '' }}
                                                {{ $isPast ? 'text-gray-500' : '' }}
                                                {{ $isUpcoming ? 'text-blue-700' : '' }}">
                                                {{ $dayEvents->first()->title }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                @php $current->addDay(); @endphp
                            @endwhile
                        </div>
                    </div>
                @endfor
            </div>
            
            <!-- Back Button -->
            <div class="text-center mt-12">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 id="modalDate" class="text-lg font-semibold text-gray-900"></h3>
                    <button onclick="closeEventModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Content -->
                <div id="modalEvents" class="p-6 max-h-96 overflow-y-auto">
                    <!-- Events will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</x-layouts.marketing>

<!-- Floating Tooltip -->
<div id="eventTooltip" class="fixed z-50 hidden pointer-events-none">
    <div class="bg-gray-900 text-white text-xs rounded-lg px-3 py-2 shadow-lg max-w-xs">
        <div id="tooltipContent"></div>
        <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
    </div>
</div>

<script>
let tooltip = null;

function showTooltip(element, events) {
    tooltip = document.getElementById('eventTooltip');
    const tooltipContent = document.getElementById('tooltipContent');
    
    let content = '';
    events.forEach((event, index) => {
        if (index > 0) content += '<hr class="my-1 border-gray-600">';
        content += `
            <div class="font-semibold">${event.title}</div>
            <div class="text-gray-300">${event.time}</div>
            ${event.location ? `<div class="text-gray-400 text-xs">${event.location}</div>` : ''}
        `;
    });
    
    if (events.length > 1) {
        content += `<div class="text-xs text-yellow-300 mt-1">Click pentru detalii complete</div>`;
    } else {
        content += `<div class="text-xs text-yellow-300 mt-1">Click pentru a vedea evenimentul</div>`;
    }
    
    tooltipContent.innerHTML = content;
    
    // Position tooltip
    const rect = element.getBoundingClientRect();
    tooltip.style.left = (rect.left + rect.width / 2 - 100) + 'px';
    tooltip.style.top = (rect.top - 10) + 'px';
    tooltip.style.transform = 'translateY(-100%)';
    
    // Adjust if tooltip would go off screen
    const tooltipRect = tooltip.getBoundingClientRect();
    if (tooltipRect.left < 10) {
        tooltip.style.left = '10px';
    }
    if (tooltipRect.right > window.innerWidth - 10) {
        tooltip.style.left = (window.innerWidth - tooltipRect.width - 10) + 'px';
    }
    
    tooltip.classList.remove('hidden');
}

function hideTooltip() {
    if (tooltip) {
        tooltip.classList.add('hidden');
    }
}

function goToEvent(slug) {
    window.open('/evenimente/' + slug, '_blank');
}

// Alternative function for multiple events on one day
function showEventsForDate(dateString, events) {
    if (events.length === 1) {
        goToEvent(events[0].slug);
    } else {
        // Show modal for multiple events
        const modal = document.getElementById('eventModal');
        const modalDate = document.getElementById('modalDate');
        const modalEvents = document.getElementById('modalEvents');
        
        // Format date for display
        const date = new Date(dateString);
        const romanianMonths = {
            'January': 'Ianuarie', 'February': 'Februarie', 'March': 'Martie',
            'April': 'Aprilie', 'May': 'Mai', 'June': 'Iunie',
            'July': 'Iulie', 'August': 'August', 'September': 'Septembrie',
            'October': 'Octombrie', 'November': 'Noiembrie', 'December': 'Decembrie'
        };
        const romanianDays = {
            'Monday': 'Luni', 'Tuesday': 'Marți', 'Wednesday': 'Miercuri',
            'Thursday': 'Joi', 'Friday': 'Vineri', 'Saturday': 'Sâmbătă', 'Sunday': 'Duminică'
        };
        
        let formattedDate = date.toLocaleDateString('en-US', { 
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
        });
        Object.keys(romanianMonths).forEach(month => {
            formattedDate = formattedDate.replace(month, romanianMonths[month]);
        });
        Object.keys(romanianDays).forEach(day => {
            formattedDate = formattedDate.replace(day, romanianDays[day]);
        });
        
        modalDate.textContent = formattedDate;
        
        // Build events HTML
        let eventsHTML = '';
        events.forEach(event => {
            eventsHTML += `
                <div class="bg-gray-50 rounded-lg p-4 mb-4 hover:bg-blue-50 transition-colors duration-200 cursor-pointer transform hover:scale-105"
                     onclick="window.open('/evenimente/${event.slug}', '_blank')">
                    <h4 class="font-semibold text-gray-900 mb-2">${event.title}</h4>
                    
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            ${event.event_start_date}${event.event_end_date ? ' - ' + event.event_end_date : ''}
                        </div>
                        
                        ${event.location ? `
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                ${event.location}
                            </div>
                        ` : ''}
                        
                        ${event.disciplines && event.disciplines.length > 0 ? `
                            <div class="flex flex-wrap gap-1 mt-2">
                                ${event.disciplines.map(discipline => `
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">${discipline}</span>
                                `).join('')}
                            </div>
                        ` : ''}
                    </div>
                    
                    <div class="mt-3 text-xs text-blue-600 font-medium flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Click pentru detalii complete
                    </div>
                </div>
            `;
        });
        
        modalEvents.innerHTML = eventsHTML;
        
        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeEventModal() {
    const modal = document.getElementById('eventModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEventModal();
        hideTooltip();
    }
});

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('eventModal');
    if (e.target === modal) {
        closeEventModal();
    }
});

// Hide tooltip on scroll
window.addEventListener('scroll', hideTooltip);
window.addEventListener('resize', hideTooltip);
</script>