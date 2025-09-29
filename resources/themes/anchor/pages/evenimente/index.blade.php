<?php
    use Wave\Event;
    use Carbon\Carbon;
    
    // Obținem ultimele 3 evenimente trecute
    $pastEvents = Event::where('status', 'published')
        ->where('event_start_date', '<', now()->startOfDay())
        ->orderBy('event_start_date', 'desc')
        ->limit(3)
        ->get();
    
    // Obținem evenimente viitoare (12 luni)
    $futureEvents = Event::where('status', 'published')
        ->where('event_start_date', '>=', now()->startOfDay())
        ->where('event_start_date', '<=', now()->addYear()->endOfDay())
        ->orderBy('event_start_date', 'asc')
        ->get();
    
    // Combinăm colecțiile și paginăm manual
    $allEvents = $pastEvents->reverse()->merge($futureEvents); // Reverse pentru ordine cronologică corectă
    
    // Paginare manuală
    $currentPage = request()->get('page', 1);
    $perPage = 9;
    $events = new \Illuminate\Pagination\LengthAwarePaginator(
        $allEvents->forPage($currentPage, $perPage),
        $allEvents->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'pageName' => 'page']
    );
?>

<x-layouts.marketing>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Competițiile CCB</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">Competițiile viitoare și ultimele evenimente finalizate ale clubului nostru.</p>
            </div>
        </div>
    </div>

    <div class="relative bg-gray-50 pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="absolute inset-0">
            <div class="bg-white h-1/3 sm:h-2/3"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">

                @if($events->count() > 0)
                    @foreach($events as $event)
                    @php
                        $status = '';
                        $statusColor = '';
                        $now = now();
                        $startDate = Carbon::parse($event->event_start_date);
                        $endDate = $event->event_end_date ? Carbon::parse($event->event_end_date) : $startDate;

                        if ($now->lt($startDate)) {
                            $days_left = intval($now->diffInDays($startDate, false));
                            if ($days_left <= 1) {
                                $status = "ÎNCEPE MÂINE";
                            } else {
                                $status = "ÎNCEPE ÎN: {$days_left} ZILE";
                            }
                            $statusColor = 'bg-blue-600';
                        } elseif ($now->between($startDate, $endDate->endOfDay())) {
                            $status = 'LIVE';
                            $statusColor = 'bg-green-600';
                        } elseif ($now->gt($endDate)) {
                            $status = 'FINISHED';
                            $statusColor = 'bg-red-600';
                        }
                    @endphp

                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-shrink-0">
                            <a href="{{ $event->link() }}">
                                <div class="relative h-40 w-full bg-gray-200 overflow-hidden">
                                    <img class="h-full w-full object-cover object-center" 
                                         src="{{ $event->image() }}" 
                                         alt="{{ $event->title }}"
                                         loading="lazy">
                                    
                                    <!-- Badge orizontal în stânga sus cu 15px de sus -->
                                    @if($status)
                                        <div class="absolute left-2 {{ $statusColor }} text-white text-xs font-bold uppercase px-2 py-1 rounded-md" style="top: 15px;">
                                            {{ $status }}
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="flex-1 bg-white p-3 flex flex-col justify-between">
                            <div class="flex-1">
                                <a href="{{ $event->link() }}" class="block">
                                    <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-2">{{ $event->title }}</h3>
                                </a>
                                
                                <!-- Prima linie: Data și Locația -->
                                <div class="flex flex-wrap items-center gap-2 mb-1 text-xs">
                                    @if($event->event_start_date)
                                        <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded">
                                            📅 {{ Carbon::parse($event->event_start_date)->format('d.m.y') }}
                                            @if($event->event_end_date && $event->event_start_date != $event->event_end_date)
                                                - {{ Carbon::parse($event->event_end_date)->format('d.m.y') }}
                                            @endif
                                        </span>
                                    @endif
                                    @if($event->location)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded">📍 {{ Str::limit($event->location, 15) }}</span>
                                    @endif
                                </div>

                                <!-- A doua linie: Booking dates -->
                                @if($event->booking_start_date || $event->booking_end_date)
                                    <div class="flex flex-wrap gap-1 mb-1 text-xs">
                                        @if($event->booking_start_date)
                                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded">� Înscrieri din: {{ Carbon::parse($event->booking_start_date)->format('d.m.y') }}</span>
                                        @endif
                                        @if($event->booking_end_date)
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded">⏰ Până pe: {{ Carbon::parse($event->booking_end_date)->format('d.m.y') }}</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- A treia linie: Discipline și Arbitri pe același rând -->
                                <div class="mb-1 text-xs">
                                    @if($event->disciplines && count($event->disciplines) > 0)
                                        <span class="mr-3">
                                            <span class="font-medium text-gray-700">🏆 Discipline:</span>
                                            @foreach(array_slice($event->disciplines, 0, 2) as $discipline)
                                                <span class="bg-blue-100 text-blue-800 px-1 py-0.5 rounded mr-1">{{ Str::limit($discipline, 10) }}</span>
                                            @endforeach
                                            @if(count($event->disciplines) > 2)
                                                <span class="text-gray-500">+{{ count($event->disciplines) - 2 }}</span>
                                            @endif
                                        </span>
                                    @endif

                                    @if($event->judges && count($event->judges) > 0)
                                        <span>
                                            <span class="font-medium text-gray-700">⚖️ Arbitri:</span>
                                            <span class="text-gray-600">{{ Str::limit(implode(', ', array_slice($event->judges, 0, 1)), 15) }}</span>
                                            @if(count($event->judges) > 1)
                                                <span class="text-gray-500">+{{ count($event->judges) - 1 }}</span>
                                            @endif
                                        </span>
                                    @endif
                                </div>

                                <!-- Excerpt mai scurt -->
                                <p class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($event->excerpt, 60) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-3 text-center py-16">
                        <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-3">Nu sunt competiții disponibile</h3>
                        <p class="text-gray-600 mb-6">Nu sunt programate competiții noi și nici evenimente recente.<br>Verificați din nou în curând pentru actualizări!</p>
                        <a href="{{ url('/calendar-competitional') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Vezi calendarul competițional
                        </a>
                    </div>
                @endif

            </div>

            <!-- Paginare -->
            @if($events->count() > 0)
                <div class="my-12">
                    {{ $events->links() }}
                </div>
            @endif

        </div>
    </div>

</x-layouts.marketing>