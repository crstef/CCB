<?php
    use Wave\Event;
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    if (!Str::startsWith(request()->path(), 'evenimente/')) {
        return;
    }

    $slug = request()->segment(2);
    $event = Event::where('slug', $slug)->firstOrFail();
    
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

<x-layouts.marketing
    :seo="[
        'title' => $event->title,
        'description' => $event->excerpt ?? Str::limit(strip_tags($event->body), 150),
        'image' => $event->image ? asset('storage/' . $event->image) : '',
    ]"

    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg shadow-lg overflow-hidden">
                <!-- Imaginea principala -->
                <div class="relative">
                    <img class="h-96 w-full object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                    @if($status)
                        <div class="absolute top-4 right-4 {{ $statusColor }} text-white text-sm font-bold uppercase px-3 py-1 rounded-md">{{ $status }}</div>
                    @endif
                </div>

                <div class="flex flex-col lg:flex-row">
                    <!-- Coloana Stanga (Galbena) cu detalii -->
                    <div class="w-full lg:w-1/3 bg-yellow-400 p-6 text-gray-800">
                        <h3 class="text-2xl font-bold mb-4">Detalii Eveniment</h3>
                        
                        @if($event->disciplines && count($event->disciplines) > 0)
                        <div class="mb-4">
                            <h4 class="font-bold uppercase mb-2">Discipline</h4>
                            <ul class="list-disc list-inside">
                                @foreach($event->disciplines as $discipline)
                                    <li>{{ $discipline }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($event->judges && count($event->judges) > 0)
                        <div class="mb-4">
                            <h4 class="font-bold uppercase mb-2">Arbitri</h4>
                            <ul class="list-disc list-inside">
                                @foreach($event->judges as $judge)
                                    <li>{{ $judge }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($event->location)
                        <div class="mb-4">
                            <h4 class="font-bold uppercase mb-2">Locație</h4>
                            <p>{{ $event->location }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Coloana Dreapta cu continut -->
                    <div class="w-full lg:w-2/3 p-6">
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($event->event_start_date)
                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-gray-500">
                                    Data Evenimentului: {{ Carbon::parse($event->event_start_date)->format('d-m-Y') }}
                                </span>
                            @endif
                             @if($event->booking_start_date)
                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-orange-500">
                                    Start Înscrieri: {{ Carbon::parse($event->booking_start_date)->format('d-m-Y') }}
                                </span>
                            @endif
                            @if($event->booking_end_date)
                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-white bg-red-500">
                                    Închidere Înscrieri: {{ Carbon::parse($event->booking_end_date)->format('d-m-Y') }}
                                </span>
                            @endif
                        </div>
                        <h1 class="text-4xl font-bold text-gray-900">{{ $event->title }}</h1>
                        <div class="prose prose-lg max-w-none mt-6">
                            {!! $event->body !!}
                        </div>

                        @if($event->caniva_link)
                        <div class="mt-8">
                            <a href="{{ $event->caniva_link }}" target="_blank" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                                Înscrie-te pe Caniva
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.marketing>