{{-- Include custom gallery button styles --}}
<link rel="stylesheet" href="{{ asset('css/gallery-buttons.css') }}">
<style>
/* High Priority Gallery Button Overrides */
a.gallery-button,
a.gallery-button:link,
a.gallery-button:visited {
    background-color: #6b7280 !important;
    background: #6b7280 !important;
    border: 3px solid #6b7280 !important;
    border-radius: 1rem !important;
    padding: 1rem 2rem !important;
    position: relative !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 60px !important;
    color: #ffffff !important;
}

a.gallery-button:hover,
a.gallery-button:focus,
a.gallery-button:active {
    background-color: #000000 !important;
    background: #000000 !important;
    border-color: #000000 !important;
    transform: scale(1.05) !important;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    color: #ffffff !important;
    text-decoration: none !important;
}

a.gallery-button .gallery-button-inner {
    background-color: #6b7280 !important;
    background: #6b7280 !important;
    border-radius: 0.75rem !important;
    padding: 0.75rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    width: 100% !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
}

a.gallery-button:hover .gallery-button-inner {
    background-color: #000000 !important;
    background: #000000 !important;
}

a.gallery-button .gallery-button-text {
    color: #ffffff !important;
    font-weight: bold !important;
    font-size: 1.125rem !important;
    margin-left: 0.75rem !important;
}

a.gallery-button .gallery-button-icon {
    color: #ffffff !important;
    width: 1.5rem !important;
    height: 1.5rem !important;
    transition: transform 0.3s ease !important;
}

a.gallery-button:hover .gallery-button-icon {
    transform: rotate(12deg) scale(1.1) !important;
    color: #ffffff !important;
}
</style>

<section class="relative top-0 flex flex-col items-center justify-center w-full min-h-screen -mt-24 bg-white lg:min-h-screen">
    
    <div class="flex flex-col items-center justify-between flex-1 w-full max-w-2xl gap-2 px-8 pt-32 mx-auto text-left md:px-12 xl:px-20 lg:pt-32 lg:pb-4 lg:max-w-7xl lg:flex-row">
        
        {{-- Left Column: Media Carousel from organized media components --}}
        <div class="w-full lg:w-1/2">
            <div class="w-full mb-2 lg:mb-0 max-w-2xl mx-auto lg:mx-0">
                {{-- Premium Media Carousel with database-driven content from Gallery category --}}
                @livewire('media-carousel', ['height' => 'h-[400px] lg:h-[450px]'])
                
                {{-- Premium Gallery Navigation Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 mt-6 justify-center">
                    {{-- Photo Gallery Button --}}
                    <a href="{{ route('galerie-foto') }}" class="gallery-button">
                        <div class="gallery-button-inner">
                            <svg class="gallery-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="gallery-button-text">Galerie Foto</span>
                        </div>
                    </a>
                    
                    {{-- Video Gallery Button --}}
                    <a href="{{ route('galerie-video') }}" class="gallery-button">
                        <div class="gallery-button-inner">
                            <svg class="gallery-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="gallery-button-text">Galerie Video</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Logo --}}
        <div class="w-full lg:w-1/2">
            <div class="flex items-center justify-center w-full mt-4 lg:mt-0">
                <img alt="CCB Character" class="relative w-full lg:scale-110 xl:translate-x-6" src="/wave/img/Logo_black.png" style="max-width:400px;">
            </div>
        </div>
    </div>
    
    {{-- Original Wave 3.0 Bottom Section --}}
    <div class="flex-shrink-0 lg:h-[150px] flex border-t border-zinc-200 items-center w-full bg-white mt-2 lg:mt-0">
        <div class="grid h-auto grid-cols-1 px-8 py-8 mx-auto space-y-5 divide-y max-w-7xl lg:space-y-0 lg:divide-y-0 divide-zinc-200 lg:py-0 lg:divide-x md:px-12 lg:px-20 lg:divide-zinc-200 lg:grid-cols-3">
            <div class="">
                <h3 class="flex items-center font-medium text-zinc-900">
                    Cum devii membru
                </h3>
                <p class="mt-2 text-sm font-medium text-zinc-500">
                    Modalitatea și beneficiile de a deveni membru. <span class="hidden lg:inline">Mai multe explicații</span>
                </p>
            </div>
            <div class="pt-5 lg:pt-0 lg:px-10">
                <h3 class="font-medium text-zinc-900">Misiunea Clubului</h3>
                <p class="mt-2 text-sm text-zinc-500">
                    Ce ne propunem să realizăm. <span class="hidden lg:inline">Explică aici.</span>
                </p>
            </div>
            <div class="pt-5 lg:pt-0 lg:px-10">
                <h3 class="font-medium text-zinc-900">Calendar Competițional</h3>
                <p class="mt-2 text-sm text-zinc-500">
                    Calendarul competițional pe anul în curs.
                </p>
            </div>
        </div>
    </div>
</section>