<section>
    <x-marketing.elements.heading
        level="h2"
        title="Servicii CCB"
        description="Servicii oferite de CCB." 
    />
    <div class="text-center">
        <div class="grid grid-cols-2 gap-x-6 gap-y-12 mt-12 text-center lg:mt-16 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-16">
            @php
                $features = \App\Models\Feature::active()->ordered()->get();
            @endphp
            
            @foreach($features as $feature)
            <div>
                <div class="flex justify-center items-center mx-auto bg-zinc-100 rounded-full size-16">
                    @if($feature->image)
                        <img src="{{ $feature->image_url }}" alt="{{ $feature->title }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <x-dynamic-component :component="'phosphor-' . $feature->icon" class="w-8 h-8" />
                    @endif
                </div>
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-zinc-900">{{ $feature->title }}</h3>
                    <p class="mt-2 text-base text-zinc-500">
                        {{ $feature->description }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>