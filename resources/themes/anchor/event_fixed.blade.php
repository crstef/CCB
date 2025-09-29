<x-layouts.marketing>
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
                    <a href="/evenimente" 
                       class="inline-flex items-center text-blue-100 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Inapoi la Evenimente
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
                            
                            @if($event['booking_end_date'] && \Carbon\Carbon::parse($event['booking_end_date'])->isFuture())
                                <span class="inline-flex items-center bg-green-500/90 backdrop-blur-sm text-white text-sm font-medium px-3 py-1 rounded-full">
                                    Inscrieri deschise
                                </span>
                            @elseif(\Carbon\Carbon::parse($event['event_start_date'])->isFuture())
                                <span class="inline-flex items-center bg-blue-500/90 backdrop-blur-sm text-white text-sm font-medium px-3 py-1 rounded-full">
                                    Programat
                                </span>
                            @else
                                <span class="inline-flex items-center bg-gray-500/90 backdrop-blur-sm text-white text-sm font-medium px-3 py-1 rounded-full">
                                    Finalizat
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Event Title -->
                    @if($event['location'])
                        <div class="mb-4">
                            <div class="flex items-center justify-center sm:justify-start text-blue-100 mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span class="font-medium">{{ $event['location'] }}</span>
                            </div>
                        </div>
                    @endif
                    
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6 leading-tight">
                        {{ $event['title'] }}
                    </h1>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($event['excerpt'])
                        <div class="mb-8">
                            <div class="prose prose-lg max-w-none text-gray-600">
                                {!! $event['excerpt'] !!}
                            </div>
                        </div>
                    @endif
                    
                    @if($event['body'])
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Detalii complete</h2>
                            <div class="prose prose-lg max-w-none text-gray-600">
                                {!! $event['body'] !!}
                            </div>
                        </div>
                    @endif
                    
                    @if($event['disciplines'] && count($event['disciplines']) > 0)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Discipline</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($event['disciplines'] as $discipline)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $discipline }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($event['judges'] && count($event['judges']) > 0)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Arbitrii</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($event['judges'] as $judge)
                                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0">
                                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $judge }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-lg p-6 sticky top-6">
                        <!-- Event Date -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">CAND</h4>
                            <p class="text-lg font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($event['event_start_date'])->format('d M Y') }}
                                @if($event['event_end_date'] && $event['event_end_date'] !== $event['event_start_date'])
                                    <br>
                                    <span class="text-gray-600">pana la</span><br>
                                    {{ \Carbon\Carbon::parse($event['event_end_date'])->format('d M Y') }}
                                @endif
                            </p>
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
                                <h4 class="text-sm font-medium text-gray-500 mb-2">INSCRIERI</h4>
                                @if($event['booking_end_date'] && \Carbon\Carbon::parse($event['booking_end_date'])->isFuture())
                                    <div class="text-green-700 font-medium">Deschise</div>
                                    <div class="text-sm text-gray-600">
                                        pana la {{ \Carbon\Carbon::parse($event['booking_end_date'])->format('d M Y') }}
                                    </div>
                                @else
                                    <div class="text-gray-600">Inchise</div>
                                @endif
                            </div>
                        @endif

                        <!-- Caniva Registration Link -->
                        @if(isset($event->caniva_link) && $event->caniva_link)
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">INSCRIERE</h4>
                                <a href="{{ $event->caniva_link }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center w-full justify-center px-4 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Inscriere Caniva
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Back to Events -->
            <div class="text-center mt-12">
                <a href="/evenimente" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Inapoi la Evenimente
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>