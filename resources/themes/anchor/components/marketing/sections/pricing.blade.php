<section>
    <x-marketing.elements.heading
        level="h2"
        title="Obiective & Informații CCB"
        description="Obiectivele noastre de viitor și informații importante despre activitatea CCB." 
    />
    <div class="text-center">
        <div class="grid grid-cols-1 gap-x-6 gap-y-12 mt-12 text-center lg:mt-16 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">
            @php
                $featureGoals = \App\Models\FeatureGoal::active()->ordered()->get();
            @endphp
            
            @foreach($featureGoals as $featureGoal)
            <div class="flex flex-col items-center">
                <!-- Imagine sau iconiță -->
                @if($featureGoal->image)
                    <div class="flex justify-center items-center mx-auto bg-zinc-100 rounded-lg overflow-hidden size-24 mb-6">
                        <img src="{{ $featureGoal->image_url }}" alt="{{ $featureGoal->title }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="flex justify-center items-center mx-auto bg-zinc-100 rounded-full size-12 mb-6">
                        <x-dynamic-component :component="'phosphor-' . $featureGoal->icon" class="w-6 h-6" />
                    </div>
                @endif
                
                <!-- Conținut -->
                <div class="text-center">
                    <h3 class="font-medium text-zinc-900 text-lg mb-3">{{ $featureGoal->title }}</h3>
                    <p class="text-sm text-zinc-500 leading-relaxed">
                        {{ $featureGoal->description }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($featureGoals->count() === 0)
            <div class="mt-12 text-center text-zinc-500">
                <p>Nu sunt obiective configurate momentan.</p>
                <p class="text-sm mt-2">Administratorii pot adăuga obiective din panoul de administrare.</p>
            </div>
        @endif
    </div>
</section>