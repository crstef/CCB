<?php
    use Wave\Event;
    use Carbon\Carbon;
    $events = Event::where('status', 'published')->orderBy('created_at', 'desc')->paginate(10);
?>

<x-layouts.marketing>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Evenimente</h2>
                <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Ultimele Noutăți</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">Fii la curent cu cele mai recente evenimente și activități.</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid de carduri -->
        <div class="mt-12 max-w-lg mx-auto grid gap-8 lg:grid-cols-3 lg:max-w-none">

            @foreach($events as $event)
                @php
                    $status = '';
                    $statusColor = '';
                    if ($event->booking_end_date && Carbon::parse($event->booking_end_date)->isPast()) {
                        $status = 'Înscrieri încheiate';
                        $statusColor = 'bg-red-100 text-red-800';
                    } elseif ($event->booking_start_date && Carbon::parse($event->booking_start_date)->isFuture()) {
                        $status = 'Înscrieri în curând';
                        $statusColor = 'bg-yellow-100 text-yellow-800';
                    } elseif ($event->booking_start_date && $event->booking_end_date && now()->between($event->booking_start_date, $event->booking_end_date)) {
                        $status = 'Înscrieri deschise';
                        $statusColor = 'bg-green-100 text-green-800';
                    }
                @endphp

                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0 relative">
                        <a href="{{ url('/evenimente/' . $event->slug) }}">
                            <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        </a>
                        @if($status)
                            <span class="absolute top-2 left-2 px-2 py-1 text-xs font-bold uppercase rounded-full {{ $statusColor }}">
                                {{ $status }}
                            </span>
                        @endif
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="mb-2">
                                @if($event->event_start_date)
                                <p class="text-sm font-semibold text-indigo-600">
                                    <time datetime="{{ Carbon::parse($event->event_start_date)->toDateString() }}">{{ Carbon::parse($event->event_start_date)->format('d F Y') }}</time>
                                </p>
                                @endif
                                @if($event->location)
                                <p class="text-sm text-gray-500 mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $event->location }}
                                </p>
                                @endif
                            </div>
                            <a href="{{ url('/evenimente/' . $event->slug) }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">{{ $event->title }}</p>
                                <p class="mt-3 text-base text-gray-500">{{ $event->excerpt }}</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <a href="#">
                                    <span class="sr-only">{{ $event->user->name }}</span>
                                    <img class="h-10 w-10 rounded-full" src="{{ $event->user->avatar() }}" alt="">
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <a href="#" class="hover:underline">{{ $event->user->name }}</a>
                                </p>
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