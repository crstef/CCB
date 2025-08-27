<section class="w-full">
    <x-marketing.elements.heading level="h2" title="Echipa CCB" description="Cunoaște echipa CCB și povestile lor de succes." />
    
    @php
        $testimonials = \App\Models\Testimonial::active()->ordered()->get();
    @endphp
    
    @if($testimonials->count() > 0)
        <ul role="list" class="grid grid-cols-1 gap-12 py-12 mx-auto max-w-2xl lg:max-w-none lg:grid-cols-3">
            @foreach($testimonials as $testimonial)
            <li>
                <figure class="flex flex-col justify-between h-full">
                    @if($testimonial->description)
                    <blockquote class="">
                        <p class="text-base sm:text-lg font-medium text-zinc-500">
                            {{ $testimonial->description }}
                        </p>
                    </blockquote>
                    @endif
                    <figcaption class="flex flex-col justify-between {{ $testimonial->description ? 'mt-6' : '' }}">
                        @if($testimonial->image)
                            <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <!-- Fallback icon dacă nu există imagine -->
                            <svg class="w-10 h-10 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
                        <div class="mt-4">
                            <div class="text-lg font-semibold text-zinc-900">{{ $testimonial->name }}</div>
                            <div class="mt-1 text-base text-zinc-500">
                                {{ $testimonial->position }}
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </li>
            @endforeach
        </ul>
    @else
        <div class="py-12 text-center text-zinc-500">
            <p>Nu sunt membri ai echipei configurați momentan.</p>
            <p class="text-sm mt-2">Administratorii pot adăuga membri din panoul de administrare.</p>
        </div>
    @endif
</section>