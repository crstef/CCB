<?php
    use Wave\Event;
    use Carbon\Carbon;
    $events = Event::where('status', 'published')->orderBy('created_at', 'desc')->paginate(9);
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

    <div class="relative bg-gray-50 pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="absolute inset-0">
            <div class="bg-white h-1/3 sm:h-2/3"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">

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
                                $status = "Începe mâine";
                            } else {
                                $status = "Începe în: {$days_left} zile";
                            }
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
                        <div class="flex-shrink-0">
                            <a href="{{ $event->link() }}">
                                <div class="relative">
                                    <img class="h-48 w-full object-cover" src="{{ $event->image() }}" alt="{{ $event->title }}">
                                    @if($status)
                                        <div class="absolute top-2 right-2 {{ $statusColor }} text-white text-xs font-bold uppercase px-2 py-1 rounded-md">{{ $status }}</div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <div class="mb-3">
                                    @if($event->event_start_date)
                                        <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 mb-1 px-2.5 py-0.5 rounded">
                                            📅 {{ Carbon::parse($event->event_start_date)->format('d.m.Y') }}
                                            @if($event->event_end_date && $event->event_start_date != $event->event_end_date)
                                                - {{ Carbon::parse($event->event_end_date)->format('d.m.Y') }}
                                            @endif
                                        </span>
                                    @endif
                                    @if($event->location)
                                        <span class="inline-block bg-green-100 text-green-800 text-xs font-medium mr-2 mb-1 px-2.5 py-0.5 rounded">
                                            📍 {{ $event->location }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ $event->link() }}" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">{{ $event->title }}</p>
                                    <p class="mt-2 text-base text-gray-500 line-clamp-2">{{ $event->excerpt }}</p>
                                </a>

                                <!-- Booking dates -->
                                @if($event->booking_start_date || $event->booking_end_date)
                                    <div class="mt-3">
                                        @if($event->booking_start_date)
                                            <span class="inline-block bg-orange-100 text-orange-800 text-xs font-medium mr-2 mb-1 px-2.5 py-0.5 rounded">
                                                🟢 Înscrieri: {{ Carbon::parse($event->booking_start_date)->format('d.m.Y') }}
                                            </span>
                                        @endif
                                        @if($event->booking_end_date)
                                            <span class="inline-block bg-red-100 text-red-800 text-xs font-medium mr-2 mb-1 px-2.5 py-0.5 rounded">
                                                🔴 Închidere: {{ Carbon::parse($event->booking_end_date)->format('d.m.Y') }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Disciplines -->
                                @if($event->disciplines && count($event->disciplines) > 0)
                                    <div class="mt-3">
                                        <p class="text-sm font-medium text-gray-700 mb-1">Discipline:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($event->disciplines as $discipline)
                                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">{{ $discipline }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Judges -->
                                @if($event->judges && count($event->judges) > 0)
                                    <div class="mt-3">
                                        <p class="text-sm font-medium text-gray-700 mb-1">Arbitri:</p>
                                        <div class="text-sm text-gray-600">
                                            @foreach($event->judges as $judge)
                                                <span class="block">• {{ $judge }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
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
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <time datetime="{{ $event->created_at }}">{{ $event->created_at->diffForHumans() }}</time>
                                    </div>
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
    </div>

</x-layouts.marketing>