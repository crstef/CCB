<x-layouts.marketing
    :seo="[
        'title' => $event->title,
        'description' => $event->excerpt ?? Str::limit(strip_tags($event->body), 150),
        'image' => $event->image ? asset('storage/' . $event->image) : '',
    ]"
>

    <div class="bg-white">
        <div class="relative isolate overflow-hidden bg-gradient-to-b from-indigo-100/20">
            <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:px-8 lg:pt-16">
                <div class="mx-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
                    <div class="w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
                        <!-- Categories -->
                        <div class="mb-4">
                            @if($event->categories->isNotEmpty())
                                <div class="flex flex-wrap gap-2">
                                    @foreach($event->categories as $category)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">{{ $event->title }}</h1>
                        <p class="relative mt-6 text-lg leading-8 text-gray-600 sm:max-w-md lg:max-w-none">{{ $event->excerpt }}</p>
                        
                        <!-- Author Info -->
                        <div class="mt-6 flex items-center gap-x-4">
                            <img src="{{ $event->user->avatar() }}" alt="Autor" class="h-10 w-10 rounded-full bg-gray-50">
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    {{ $event->user->name }}
                                </p>
                                <p class="text-gray-600">Publicat la {{ $event->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-14 flex justify-end gap-8 sm:-mt-44 sm:justify-start sm:pl-20 lg:mt-0 lg:pl-0">
                        <div class="ml-auto w-44 flex-none space-y-8 pt-32 sm:ml-0 sm:pt-80 lg:order-last lg:pt-36 xl:order-none xl:pt-80">
                            <div class="relative">
                                @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg">
                                <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10"></div>
                                @else
                                <div class="aspect-[2/3] w-full rounded-xl bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 prose prose-lg max-w-none">
                {!! $event->body !!}
            </div>

            <!-- Sidebar with Details -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Detalii Eveniment</h3>
                    <dl class="space-y-4">
                        @if($event->location)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Locație</dt>
                            <dd class="mt-1 text-md text-gray-900 font-semibold">{{ $event->location }}</dd>
                        </div>
                        @endif

                        @if($event->event_start_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Data Evenimentului</dt>
                            <dd class="mt-1 text-md text-gray-900 font-semibold">{{ $event->event_start_date->format('d F Y') }}</dd>
                        </div>
                        @endif

                        @if($event->booking_start_date || $event->booking_end_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Perioada de Înscrieri</dt>
                            <dd class="mt-1 text-md text-gray-900 font-semibold">
                                {{ $event->booking_start_date ? $event->booking_start_date->format('d M') : '' }} - {{ $event->booking_end_date ? $event->booking_end_date->format('d M, Y') : '' }}
                            </dd>
                        </div>
                        @endif

                        @if($event->disciplines && count($event->disciplines) > 0)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Discipline</dt>
                            <dd class="mt-1 flex flex-wrap gap-2">
                                @foreach($event->disciplines as $discipline)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ $discipline }}</span>
                                @endforeach
                            </dd>
                        </div>
                        @endif

                        @if($event->judges && count($event->judges) > 0)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Arbitri</dt>
                            <dd class="mt-1 flex flex-wrap gap-2">
                                @foreach($event->judges as $judge)
                                    <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ $judge }}</span>
                                @endforeach
                            </dd>
                        </div>
                        @endif

                        @if($event->caniva_link)
                        <div class="pt-4">
                            <a href="{{ $event->caniva_link }}" target="_blank" class="w-full text-center inline-block px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Înscrie-te pe Caniva
                            </a>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

</x-layouts.marketing>
