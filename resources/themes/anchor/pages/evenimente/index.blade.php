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
                    $isFinished = $event->event_start_date && Carbon::parse($event->event_start_date)->isPast();
                @endphp
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <a href="{{ url('/evenimente/' . $event->slug) }}">
                        <div class="flex-shrink-0 relative">
                            <img class="h-64 w-full object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            @if($isFinished)
                                <div class="absolute top-4 right-4 bg-red-600 text-white text-sm font-bold uppercase px-3 py-1 rounded-md">Finished</div>
                            @endif
                        </div>
                    </a>
                    <div class="flex-1 bg-white flex">
                        <!-- Coloana Stanga (Galbena) -->
                        @if($event->disciplines && count($event->disciplines) > 0)
                        <div class="bg-yellow-400 p-4 flex flex-col justify-center items-center w-1/3">
                            <ul class="text-center text-gray-800 font-bold">
                                @foreach($event->disciplines as $discipline)
                                    <li class="py-1">{{ strtoupper($discipline) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

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
                                            Start Book: {{ Carbon::parse($event->booking_start_date)->format('d-m-Y') }}
                                        </span>
                                    @endif
                                    @if($event->booking_end_date)
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-orange-500">
                                            Stop Book: {{ Carbon::parse($event->booking_end_date)->format('d-m-Y') }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ url('/evenimente/' . $event->slug) }}" class="block">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h3>
                                    @if($event->location)
                                        <p class="text-md font-semibold text-gray-600 mt-1">{{ $event->location }}</p>
                                    @endif
                                    <p class="mt-3 text-base text-gray-500 line-clamp-3">{{ $event->excerpt }}</p>
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