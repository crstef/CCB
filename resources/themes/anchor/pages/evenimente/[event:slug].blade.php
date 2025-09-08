<?php
use Wave\Event;
use Carbon\Carbon;

// În Folio, parametrii din URL sunt accesibili direct ca variabile
// Verificăm dacă suntem într-o rută de eveniment
if (!isset($event) || !$event) {
    $currentPath = request()->path();
    if (str_starts_with($currentPath, 'evenimente/')) {
        $slug = basename($currentPath);
        $event = Event::where('slug', $slug)->where('status', 'published')->first();
        
        if (!$event) {
            abort(404, 'Evenimentul nu a fost găsit.');
        }
    } else {
        // Nu suntem pe o pagină de eveniment, nu executăm restul codului
        return;
    }
}

// Calculăm statusul evenimentului
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
?>

<x-layouts.marketing>
    <div class="relative py-16 bg-white overflow-hidden">
        <div class="relative px-4 sm:px-6 lg:px-8">
            <div class="text-lg max-w-prose mx-auto">
                <!-- Breadcrumb -->
                <nav class="flex mb-8" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-500">
                                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                    <span class="sr-only">Acasă</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                </svg>
                                <a href="{{ url('/evenimente') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Evenimente</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-500">{{ $event->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Status Badge -->
                @if($status)
                    <div class="mb-6">
                        <span class="{{ $statusColor }} text-white text-sm font-bold uppercase px-4 py-2 rounded-lg">{{ $status }}</span>
                    </div>
                @endif

                <!-- Titlu -->
                <h1 class="mt-2 mb-8 text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    {{ $event->title }}
                </h1>

                <!-- Meta informații compacte -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Coloana stânga -->
                        <div class="space-y-3">
                            @if($event->event_start_date)
                                <div class="flex items-center text-sm">
                                    <span class="font-medium text-gray-900 w-20">📅 Data:</span>
                                    <span class="text-gray-600">
                                        {{ Carbon::parse($event->event_start_date)->format('d.m.Y') }}
                                        @if($event->event_end_date && $event->event_start_date != $event->event_end_date)
                                            - {{ Carbon::parse($event->event_end_date)->format('d.m.Y') }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                            
                            @if($event->location)
                                <div class="flex items-center text-sm">
                                    <span class="font-medium text-gray-900 w-20">📍 Locație:</span>
                                    <span class="text-gray-600">{{ $event->location }}</span>
                                </div>
                            @endif

                            @if($event->booking_start_date)
                                <div class="flex items-center text-sm">
                                    <span class="font-medium text-gray-900 w-20">🟢 Înscrieri:</span>
                                    <span class="text-gray-600">{{ Carbon::parse($event->booking_start_date)->format('d.m.Y') }}</span>
                                </div>
                            @endif

                            @if($event->booking_end_date)
                                <div class="flex items-center text-sm">
                                    <span class="font-medium text-gray-900 w-20">🔴 Închidere:</span>
                                    <span class="text-gray-600">{{ Carbon::parse($event->booking_end_date)->format('d.m.Y') }}</span>
                                </div>
                            @endif

                            @if($event->link && $event->link != '#')
                                <div class="flex items-center text-sm">
                                    <span class="font-medium text-gray-900 w-20">🔗 Link:</span>
                                    <a href="{{ $event->link }}" target="_blank" class="text-indigo-600 hover:text-indigo-500 underline">
                                        Accesează evenimentul
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Coloana dreapta -->
                        <div class="space-y-3">
                            @if($event->disciplines && count($event->disciplines) > 0)
                                <div>
                                    <span class="font-medium text-gray-900 text-sm block mb-2">🏆 Discipline:</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($event->disciplines as $discipline)
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $discipline }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($event->judges && count($event->judges) > 0)
                                <div>
                                    <span class="font-medium text-gray-900 text-sm block mb-2">⚖️ Arbitri:</span>
                                    <div class="text-sm text-gray-600">
                                        @foreach($event->judges as $judge)
                                            <div>• {{ $judge }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Imaginea principală -->
            @if($event->image)
                <div class="mt-8 mb-8">
                    <img class="w-full max-w-4xl mx-auto rounded-lg shadow-lg" src="{{ $event->image() }}" alt="{{ $event->title }}">
                </div>
            @endif

            <!-- Conținutul evenimentului -->
            <div class="mt-8 prose prose-indigo prose-lg text-gray-500 mx-auto">
               <!--  @if($event->excerpt)
                    <p class="text-xl text-gray-500 leading-8 mb-6">{{ $event->excerpt }}</p>
                @endif -->
                
                <div class="mt-6">
                    {!! $event->body !!}
                </div>
            </div>

            <!-- Autor și dată -->
            <div class="max-w-prose mx-auto mt-12 pt-8 border-t border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-12 w-12 rounded-full" src="{{ $event->user->avatar() }}" alt="{{ $event->user->name }}">
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ $event->user->name }}</p>
                        <div class="flex space-x-1 text-sm text-gray-500">
                            <time datetime="{{ $event->created_at }}">Publicat {{ $event->created_at->diffForHumans() }}</time>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buton înapoi -->
            <div class="max-w-prose mx-auto mt-8">
                <a href="{{ url('/evenimente') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ← Înapoi la evenimente
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>