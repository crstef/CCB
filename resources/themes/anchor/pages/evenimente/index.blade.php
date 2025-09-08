<?php
    use function Laravel\Folio\{name};
    use Wave\Event;
    name('evenimente');

    $events = Event::where('status', 'PUBLISHED')->orderBy('event_start_date', 'DESC')->paginate(6);
    $categories = \Wave\Category::all();
?>

<x-layouts.marketing
    :seo="[
        'title' => 'Evenimente',
        'description' => 'Evenimentele noastre recente si viitoare.',
    ]"
>
    <x-container>
        <div class="relative pt-6">
            <x-marketing.elements.heading
                title="Evenimente"
                description="Verificati unele dintre cele mai recente evenimente ale noastre mai jos."
                align="left"
            />
            
            <div class="space-y-12 mx-auto mt-5 md:mt-10">
                @include('theme::partials.events.events-loop', ['events' => $events])
            </div>
        </div>

        <div class="flex justify-center my-10">
            {{ $events->links('theme::partials.pagination') }}
        </div>

    </x-container>
</x-layouts.marketing>
