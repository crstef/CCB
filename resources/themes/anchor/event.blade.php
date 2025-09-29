<x-layouts.marketing :seo="[
    'seo_title' => $event['title'] . ' - Club Chinologic București Otopeni',
    'seo_description' => $event['excerpt'] ?? 'Eveniment organizat de Clubul Chinologic București Otopeni - ' . $event['title']
]">
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-blue-600 to-indigo-700 py-16 sm:py-20">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            @if($event['image'])
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ Storage::url($event['image']) }}" 
                         alt="{{ $event['title'] }}" 
                         class="w-full h-full object-cover object-center opacity-30"
                         loading="lazy">
                </div>
            @endif
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Navigation -->
                <div class="mb-6">
                    <a href="{{ route('calendar-competitional') }}" 
                       class="inline-flex items-center text-blue-100 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Înapoi la Calendar
                    </a>
                </div>
                
                <!-- Event Title and Meta -->
                <div class="text-center sm:text-left">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div>
                            <!-- Event Date Badge -->
                            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 mb-4">
                                <svg class="w-5 h-5 mr-2 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-white font-medium">
                                    {{ \Carbon\Carbon::parse($event['event_start_date'])->format('d M Y') }}
                                    @if($event['event_end_date'] && $event['event_end_date'] !== $event['event_start_date'])
                                        - {{ \Carbon\Carbon::parse($event['event_end_date'])->format('d M Y') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <!-- Status Badges -->
                        <div class="flex flex-wrap gap-2">
                            @if($event['booking_end_date'] && \Carbon\Carbon::parse($event['booking_end_date'])->isFuture())
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Înscrieri deschise
                                </span>
                            @elseif(\Carbon\Carbon::parse($event['event_start_date'])->isFuture())
                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Programat
                                </span>
                            @else
                                <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Finalizat
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl font-bold text-white leading-tight mb-4">
                        {{ $event['title'] }}
                    </h1>
                    
                    @if($event['location'])
                        <p class="text-xl text-blue-100 flex items-center justify-center sm:justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $event['location'] }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Event Details -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Event Description -->
                    @if($event['excerpt'])
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Despre eveniment</h2>
                            <div class="prose prose-lg max-w-none">
                                <p class="text-lg text-gray-700 leading-relaxed">{{ $event['excerpt'] }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Full Content -->
                    @if($event['body'])
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Detalii complete</h2>
                            <div class="prose prose-lg max-w-none">
                                {!! $event['body'] !!}
                            </div>
                        </div>
                    @endif

                    <!-- Disciplines -->
                    @if($event['disciplines'] && count($event['disciplines']) > 0)
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Discipline</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($event['disciplines'] as $discipline)
                                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-medium">
                                        {{ $discipline }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Judges -->
                    @if($event['judges'] && count($event['judges']) > 0)
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Judecători</h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <ul class="space-y-2">
                                    @foreach($event['judges'] as $judge)
                                        <li class="flex items-center text-gray-700">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            {{ $judge }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-xl p-6 sticky top-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Informații eveniment</h3>
                        
                        <!-- Date Info -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">CÂND</h4>
                            <div class="text-gray-900">
                                <div class="font-medium">
                                    {{ \Carbon\Carbon::parse($event['event_start_date'])->format('d M Y') }}
                                </div>
                                @if($event['event_end_date'] && $event['event_end_date'] !== $event['event_start_date'])
                                    <div class="text-sm text-gray-600">
                                        până la {{ \Carbon\Carbon::parse($event['event_end_date'])->format('d M Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Location Info -->
                        @if($event['location'])
                            <div class="mb-6">
                                <h4 class="text-sm font-medium text-gray-500 mb-2">UNDE</h4>
                                <p class="text-gray-900">{{ $event['location'] }}</p>
                            </div>
                        @endif

                        <!-- Booking Info -->
                        @if($event['booking_start_date'] || $event['booking_end_date'])
                            <div class="mb-6">
                                <h4 class="text-sm font-medium text-gray-500 mb-2">ÎNSCRIERI</h4>
                                @if($event['booking_end_date'] && \Carbon\Carbon::parse($event['booking_end_date'])->isFuture())
                                    <div class="text-green-700 font-medium">Deschise</div>
                                    <div class="text-sm text-gray-600">
                                        până la {{ \Carbon\Carbon::parse($event['booking_end_date'])->format('d M Y') }}
                                    </div>
                                @else
                                    <div class="text-gray-600">Închise</div>
                                @endif
                            </div>
                        @endif

                        <!-- Caniva Registration Link -->
                        @if(isset($event->caniva_link) && $event->caniva_link)
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">ÎNSCRIERE</h4>
                                <a href="{{ $event->caniva_link }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center w-full justify-center px-4 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Înscriere Caniva
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Back to Calendar -->
            <div class="text-center mt-12">
                <a href="{{ route('calendar-competitional') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi la Calendar Competițional
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>