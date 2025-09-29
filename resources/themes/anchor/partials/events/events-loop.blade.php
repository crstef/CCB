<!-- Loop Through Events Here -->
@foreach($events as $event)
    <article id="event-{{ $event->id }}" class="flex flex-col overflow-hidden rounded-lg shadow-lg mb-8 bg-white max-h-[600px]">
        <div class="relative">
            <a href="{{ $event->link() }}">
                <div class="h-48 w-full bg-gray-200 overflow-hidden">
                    <img class="h-full w-full object-cover object-center" 
                         src="{{ $event->image() }}" 
                         alt="{{ $event->title }}"
                         loading="lazy">
                </div>
            </a>
            @if($event->status['text'])
                <div class="absolute top-3 right-3 px-4 py-2 text-white text-base font-semibold rounded-lg {{ $event->status['class'] }} shadow-md">
                    {{ $event->status['text'] }}
                </div>
            @endif
        </div>

        <div class="flex flex-1 min-h-[250px] max-h-[400px]">
            <!-- Sidebar cu discipline -->
            <div class="w-1/4 bg-yellow-500 p-4 flex flex-col justify-start">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Discipline</h3>
                <ul class="text-gray-800 text-sm space-y-1">
                    @if(is_array($event->disciplines))
                        @foreach($event->disciplines as $discipline)
                            <li class="leading-tight">{{ strtoupper($discipline) }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- Conținut principal -->
            <div class="w-3/4 bg-white p-6 flex flex-col overflow-y-auto">
                <div class="flex-grow">
                    <div class="mb-3 space-y-2">
                        <div class="flex flex-wrap gap-x-2 gap-y-2">
                            @if($event->event_start_date)
                            <p class="text-xs font-medium text-gray-700 bg-yellow-200 px-2 py-1 rounded-full">
                                DATA: <span class="font-bold">{{ $event->event_start_date->format('d-m-Y') }}</span>
                            </p>
                            @endif
                            @if($event->booking_start_date)
                            <p class="text-xs font-medium text-gray-700 bg-green-200 px-2 py-1 rounded-full">
                                START: <span class="font-bold">{{ $event->booking_start_date->format('d-m-Y') }}</span>
                            </p>
                            @endif
                            @if($event->booking_end_date)
                            <p class="text-xs font-medium text-gray-700 bg-red-200 px-2 py-1 rounded-full">
                                STOP: <span class="font-bold">{{ $event->booking_end_date->format('d-m-Y') }}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-x-1 gap-y-1 mb-3">
                        @foreach($event->categories as $category)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <a href="{{ $event->link() }}" class="block">
                        <p class="text-xl font-bold text-gray-900 hover:text-yellow-600 transition mb-2">{{ $event->title }}</p>
                        @if($event->location)
                            <p class="text-sm font-semibold text-gray-600 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $event->location }}
                            </p>
                        @endif
                        <div class="mt-4 text-base text-gray-600 prose max-w-none leading-relaxed">
                            {!! $event->excerpt ?? strip_tags($event->body) !!}
                        </div>
                    </a>
                </div>
                
                <!-- Footer cu autor și buton -->
                <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-gray-200 overflow-hidden">
                                <img class="h-full w-full object-cover object-center" 
                                     src="{{ $event->user->avatar() }}" 
                                     alt="Avatarul autorului"
                                     loading="lazy">
                            </div>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-gray-900">{{ $event->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $event->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                    
                    @if($event->caniva_link)
                        <div class="flex-shrink-0">
                            <a href="{{ $event->caniva_link }}" target="_blank" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Caniva
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </article>
@endforeach
<!-- End Event Loop Here -->