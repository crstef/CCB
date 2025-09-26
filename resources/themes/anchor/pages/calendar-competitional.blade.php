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
    
    $dayNames = ['L', 'M', 'M', 'J', 'V', 'S', 'D'];

    $seo = [
        'seo_title' => 'Calendar Competițional ' . $currentYear,
        'seo_description' => 'Calendarul competițional pentru anul ' . $currentYear . '. Vezi toate evenimentele și concursurile.',
    ];
?>

<?php

use Wave\Event;

// Get current year and events
$currentYear = now()->year;
$events = Event::whereYear('event_date', $currentYear)->get()->groupBy('event_date');

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
                                                    $colorClass = $isPast ? 'bg-gray-400' : 'bg-blue-500';
                                                    
                                                    echo '<div class="' . $colorClass . ' text-white px-1 rounded text-center cursor-pointer hover:opacity-75" 
                                                          title="' . htmlspecialchars($event->title) . '"
                                                          onclick="window.open(\'/evenimente/' . $event->slug . '\', \'_blank\')">' . 
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
</x-layouts.marketing>
</x-layouts.marketing>

<!-- Simple Tooltip -->
<div id="simpleTooltip" class="fixed z-50 hidden pointer-events-none">
    <div class="bg-gray-800 text-white text-sm rounded px-3 py-2 shadow-lg whitespace-nowrap">
        <span id="tooltipText"></span>
        <!-- Arrow pointing down -->
        <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-800"></div>
    </div>
</div>

<script>
<script>
let simpleTooltip = null;

function showSimpleTooltip(element, eventTitle) {
    simpleTooltip = document.getElementById('simpleTooltip');
    const tooltipText = document.getElementById('tooltipText');
    
    tooltipText.textContent = eventTitle;
    
    // Position tooltip directly above the cell
    const rect = element.getBoundingClientRect();
    const tooltipWidth = simpleTooltip.offsetWidth || 200; // Estimated width
    
    simpleTooltip.style.left = (rect.left + rect.width / 2) + 'px';
    simpleTooltip.style.top = (rect.top - 10) + 'px';
    simpleTooltip.style.transform = 'translateX(-50%) translateY(-100%)';
    
    // Adjust if tooltip would go off screen
    const viewportWidth = window.innerWidth;
    const tooltipRect = simpleTooltip.getBoundingClientRect();
    
    if (tooltipRect.left < 10) {
        simpleTooltip.style.left = (rect.left + 10) + 'px';
        simpleTooltip.style.transform = 'translateY(-100%)';
    } else if (tooltipRect.right > viewportWidth - 10) {
        simpleTooltip.style.left = (rect.right - 10) + 'px';
        simpleTooltip.style.transform = 'translateX(-100%) translateY(-100%)';
    }
    
    simpleTooltip.classList.remove('hidden');
}

function hideSimpleTooltip() {
    if (simpleTooltip) {
        simpleTooltip.classList.add('hidden');
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
        hideSimpleTooltip();
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
window.addEventListener('scroll', hideSimpleTooltip);
window.addEventListener('resize', hideSimpleTooltip);
</script>