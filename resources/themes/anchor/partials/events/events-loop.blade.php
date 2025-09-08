<!-- Loop Through Events Here -->
@foreach($events as $event)
    <article id="event-{{ $event->id }}" class="flex flex-col overflow-hidden rounded-lg shadow-lg mb-8">
        <div class="relative">
            <a href="{{ $event->link() }}">
                <img class="h-80 w-full object-cover" src="{{ $event->image() }}" alt="{{ $event->title }}">
            </a>
            @if($event->status['text'])
                <div class="absolute top-3 right-3 px-4 py-2 text-white text-base font-semibold rounded-lg {{ $event->status['class'] }} shadow-md">
                    {{ $event->status['text'] }}
                </div>
            @endif
        </div>

        <div class="flex flex-1">
            <!-- Sidebar cu discipline -->
            <div class="w-1/4 bg-yellow-500 p-6 flex flex-col justify-start">
                <h3 class="text-md font-bold text-gray-900 uppercase tracking-wider mb-3">Discipline</h3>
                <ul class="text-gray-800 text-base space-y-2">
                    @if(is_array($event->disciplines))
                        @foreach($event->disciplines as $discipline)
                            <li>{{ strtoupper($discipline) }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- Conținut principal -->
            <div class="w-3/4 bg-white p-6 flex flex-col justify-between">
                <div>
                    <div class="mb-4 space-y-2">
                        <div class="flex flex-wrap gap-x-4 gap-y-2">
                            @if($event->event_start_date)
                            <p class="text-sm font-medium text-gray-700 bg-yellow-200 px-3 py-1 rounded-full">
                                DATA EVENIMENT: <span class="font-bold">{{ $event->event_start_date->format('d-m-Y') }}</span>
                            </p>
                            @endif
                            @if($event->booking_start_date)
                            <p class="text-sm font-medium text-gray-700 bg-yellow-200 px-3 py-1 rounded-full">
                                START ÎNSCRIERI: <span class="font-bold">{{ $event->booking_start_date->format('d-m-Y') }}</span>
                            </p>
                            @endif
                            @if($event->booking_end_date)
                            <p class="text-sm font-medium text-gray-700 bg-yellow-200 px-3 py-1 rounded-full">
                                STOP ÎNSCRIERI: <span class="font-bold">{{ $event->booking_end_date->format('d-m-Y') }}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-x-2 gap-y-2">
                        @foreach($event->categories as $category)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <a href="{{ $event->link() }}" class="block mt-4">
                        <p class="text-2xl font-bold text-gray-900 hover:text-yellow-600 transition">{{ $event->title }}</p>
                        @if($event->location)
                            <p class="text-lg font-semibold text-gray-600 mt-1">{{ $event->location }}</p>
                        @endif
                        <div class="mt-4 text-base text-gray-600 prose max-w-none">
                            {!! $event->excerpt ?? Str::limit(strip_tags($event->body), 200) !!}
                        </div>
                    </a>
                </div>
                <div class="mt-6 flex items-center">
                    <div class="flex-shrink-0">
                        <a href="#">
                            <span class="sr-only">{{ $event->user->name }}</span>
                            <img class="h-12 w-12 rounded-full" src="{{ $event->user->avatar() }}" alt="Avatarul autorului">
                        </a>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            <a href="#" class="hover:underline">{{ $event->user->name }}</a>
                        </p>
                        <div class="flex space-x-1 text-sm text-gray-500">
                            <time datetime="{{ $event->created_at->toIso8601String() }}">{{ $event->created_at->format('d M, Y') }}</time>
                        </div>
                    </div>
                    @if($event->caniva_link)
                        <div class="ml-auto">
                            <a href="{{ $event->caniva_link }}" target="_blank" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                Înscrie-te pe Caniva
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </article>
@endforeach
<!-- End Event Loop Here -->