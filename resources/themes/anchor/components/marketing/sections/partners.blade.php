<section class="py-12">
    <x-marketing.elements.heading
        level="h2"
        title="Partenerii noștri"
        description="Organizațiile și companiile care ne sprijină în misiunea noastră de promovare a raselor de ciobănești belgieni." 
    />
    
    <div class="mt-12">
        @php
            $partners = \App\Models\Partner::active()->ordered()->get();
        @endphp
        
        @if($partners->count() > 0)
            <div class="grid grid-cols-2 gap-6 lg:grid-cols-4 xl:grid-cols-6">
                @foreach($partners as $partner)
                    <div class="flex flex-col items-center group">
                        <a href="{{ $partner->website_url }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="block transition-transform duration-300 hover:scale-105"
                           title="{{ $partner->name }}">
                            
                            @if($partner->logo_url)
                                <div class="flex items-center justify-center w-24 h-24 p-2 bg-white border border-zinc-200 rounded-lg shadow-sm group-hover:shadow-md transition-shadow duration-300">
                                    <img src="{{ $partner->logo_url }}" 
                                         alt="{{ $partner->name }}" 
                                         class="max-w-full max-h-full object-contain">
                                </div>
                            @else
                                <div class="flex items-center justify-center w-24 h-24 bg-zinc-100 border border-zinc-200 rounded-lg">
                                    <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                        
                        <div class="mt-3 text-center">
                            <h3 class="text-sm font-medium text-zinc-900 group-hover:text-blue-600 transition-colors duration-300">
                                <a href="{{ $partner->website_url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer">
                                    {{ $partner->name }}
                                </a>
                            </h3>
                            
                            @if($partner->description)
                                <p class="mt-1 text-xs text-zinc-500 line-clamp-2">
                                    {{ $partner->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-zinc-900">Nu sunt parteneri adăugați</h3>
                <p class="mt-1 text-sm text-zinc-500">Partenerii vor fi afișați aici când vor fi adăugați.</p>
            </div>
        @endif
    </div>
</section>