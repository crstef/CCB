<?php
    use Wave\Event;
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
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <a href="{{ route('evenimente.show', $event->slug) }}">
                            <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        </a>
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-indigo-600">
                                    @if($event->categories->isNotEmpty())
                                        @foreach($event->categories as $category)
                                            <a href="#" class="hover:underline">{{ $category->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $event->created_at->format('d M, Y') }}
                                </p>
                            </div>
                            <a href="{{ route('evenimente.show', $event->slug) }}" class="block mt-2">
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