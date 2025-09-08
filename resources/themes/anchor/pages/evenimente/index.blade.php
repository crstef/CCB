<?php
    use Wave\Event;
    use Carbon\Carbon;
    $events = Event::where('status', 'published')->orderBy('created_at', 'desc')->paginate(6);
?>

<x-layouts.marketing>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Clubul de Ciobanesti Belgieni si Olandezi Romania</h2>
                <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Evenimentele Noastre</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">Fii la curent cu cele mai recente competiții, examene și activități.</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid de carduri modern -->
        <div class="mt-12 max-w-lg mx-auto grid gap-8 lg:grid-cols-2 lg:max-w-none">

            @foreach($events as $event)
                @php
                    $status = '';
                    $statusColor = '';
                    $now = now();
                    $startDate = Carbon::parse($event->event_start_date);
                    $endDate = $event->event_end_date ? Carbon::parse($event->event_end_date) : $startDate;

                    if ($now->lt($startDate)) {
                        $days_left = $now->diffInDays($startDate);
                        $status = "Mai sunt {$days_left} zile";
                        $statusColor = 'bg-blue-600';
                    } elseif ($now->between($startDate, $endDate->endOfDay())) {
                        $status = 'Live';
                        $statusColor = 'bg-green-600';
                    } elseif ($now->gt($endDate)) {
                        $status = 'Finished';
                        $statusColor = 'bg-red-600';
                    }
                @endphp
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <a href="{{ url('/evenimente/' . $event->slug) }}">
                        <div class="flex-shrink-0 relative">
                            <img class="h-64 w-full object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            @if($status)
                                <div class="absolute top-4 right-4 {{ $statusColor }} text-white text-sm font-bold uppercase px-3 py-1 rounded-md">{{ $status }}</div>
                            @endif
                        </div>
                    </a>
                    <div class="flex-1 bg-white flex">
                        <!-- Coloana Stanga (Galbena) -->
                        <div class="bg-yellow-400 p-4 flex flex-col justify-start items-center w-1/3">
                            @if($event->disciplines && count($event->disciplines) > 0)
                                <div class="text-center w-full mb-4">
                                    <h4 class="font-bold text-gray-800 uppercase border-b border-gray-600 pb-1 mb-2">Discipline</h4>
                                    <ul class="text-gray-800 font-semibold">
                                        @foreach($event->disciplines as $discipline)
                                            <li class="py-1">{{ strtoupper($discipline) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                             @if($event->judges && count($event->judges) > 0)
                                <div class="text-center w-full">
                                    <h4 class="font-bold text-gray-800 uppercase border-b border-gray-600 pb-1 mb-2">Arbitri</h4>
                                    <ul class="text-gray-800 font-semibold">
                                        @foreach($event->judges as $judge)
                                            <li class="py-1">{{ $judge }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Coloana Dreapta -->
                        <div class="p-6 flex flex-col justify-between flex-1">
                            <div>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @if($event->event_start_date)
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-gray-500">
                                            Data: {{ Carbon::parse($event->event_start_date)->format('d-m-Y') }}
                                        </span>
                                    @endif
                                     @if($event->booking_start_date)
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-orange-500">
                                            Start Înscriere: {{ Carbon::parse($event->booking_start_date)->format('d-m-Y') }}
                                        </span>
                                    @endif
                                    @if($event->booking_end_date)
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-red-500">
                                            Închidere Înscrieri: {{ Carbon::parse($event->booking_end_date)->format('d-m-Y') }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ url('/evenimente/' . $event->slug) }}" class="block">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h3>
                                    @if($event->location)
                                        <p class="text-md font-semibold text-gray-600 mt-1">{{ $event->location }}</p>
                                    @endif
                                    <p class="mt-3 text-base text-gray-500 line-clamp-4">{{ $event->excerpt }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Paginare -->
        <div class="my-12">
            {{ $events->links() }}
        </div>
    </div>

</x-layouts.marketing>