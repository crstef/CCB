{{--
    Hero Section Component
    
    This is the main hero section that appears on the homepage of the Wave 3.0 website.
    It features a two-column layout with:
    - Left side: Media carousel displaying photos and videos
    - Right side: Main content with title, description, and call-to-action buttons
    
    The layout is responsive and adapts to different screen sizes:
    - Desktop: Side-by-side layout (carousel left, content right)
    - Tablet: Stacked layout with carousel on top
    - Mobile: Single column layout
    
    Features:
    - Dynamic media carousel with auto-playing slides
    - Engaging call-to-action buttons
    - Gallery navigation links
    - Responsive design
    - Modern gradient backgrounds
    - Smooth animations and transitions
--}}

<section class="relative top-0 flex flex-col items-center justify-center w-full min-h-screen -mt-24 bg-white lg:min-h-screen">
    
    {{-- Main Content Container (Wave 3.0 Style) --}}
    <div class="flex flex-col items-center justify-between flex-1 w-full max-w-2xl gap-6 px-8 pt-32 mx-auto text-left md:px-12 xl:px-20 lg:pt-32 lg:pb-16 lg:max-w-7xl lg:flex-row">
        
        {{-- Left Column: Media Carousel --}}
        <div class="w-full lg:w-1/2 order-2 lg:order-1">
            {{-- Section Title Above Carousel --}}
            <div class="text-center lg:text-left mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Galeria Noastră</h3>
                <p class="text-sm text-gray-600">Explorează momentele noastre speciale</p>
            </div>
            
            {{-- Media Carousel Component --}}
            {{-- This Livewire component handles media loading and display --}}
            <div class="w-full mb-8 lg:mb-0 max-w-md mx-auto lg:mx-0">
                @livewire('media.media-carousel')
            </div>
            
            {{-- Gallery Navigation Buttons --}}
            <div class="flex justify-center lg:justify-start gap-4 mt-6">
                {{-- Photo Gallery Button --}}
                <a href="/galerie-foto" 
                   class="group inline-flex items-center px-6 py-3 bg-white border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm hover:shadow-md">
                    {{-- Photo icon --}}
                    <svg class="w-5 h-5 mr-2 text-blue-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Vezi Fotografiile</span>
                    {{-- Arrow icon --}}
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                
                {{-- Video Gallery Button --}}
                <a href="/galerie-video" 
                   class="group inline-flex items-center px-6 py-3 bg-white border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm hover:shadow-md">
                    {{-- Video icon --}}
                    <svg class="w-5 h-5 mr-2 text-purple-500 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Vezi Videoclipurile</span>
                    {{-- Arrow icon --}}
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

            {{-- Right Column: Original Wave 3.0 Structure with CCB Logo --}}
            <div class="w-full lg:w-1/2 order-1 lg:order-2 text-center lg:text-left">
                {{-- Main Heading (keeping original Wave 3.0 style) --}}
                <h1 class="text-6xl font-bold tracking-tighter text-left sm:text-7xl md:text-8xl sm:text-center lg:text-left text-zinc-900 text-balance">
                    <span class="block origin-left lg:scale-90 text-nowrap">Video</span> 
                    <span class="pr-4 text-transparent text-neutral-600 bg-clip-text bg-gradient-to-b from-neutral-900 to-neutral-500">poze</span>
                </h1>
                
                {{-- Description (keeping original Wave 3.0 style) --}}
                <p class="mx-auto mt-5 text-2xl font-normal text-left sm:max-w-md lg:ml-0 lg:max-w-md sm:text-center lg:text-left text-zinc-500">
                    Descoperă momentele speciale din galeria noastră foto și video
                </p>
                
                {{-- Gallery Navigation Buttons (keeping original Wave 3.0 style) --}}
                <div class="flex flex-col items-center justify-center gap-3 mx-auto mt-8 md:gap-2 lg:justify-start md:ml-0 md:flex-row">
                    <a href="/galerie-foto" class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-3 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Galerie foto
                    </a>
                    <a href="/galerie-video" class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-3 text-base font-medium text-blue-600 bg-white border border-blue-600 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Galerie video
                    </a>
                </div>
                
                {{-- Original CCB Logo (keeping exact original positioning) --}}
                <div class="flex items-center justify-center w-full mt-8 lg:mt-12">
                    <img alt="CCB Character" class="relative w-full lg:scale-125 xl:translate-x-6" src="/wave/img/Logo_black.png" style="max-width:450px;">
                </div>
            </div>
        </div>
    </div>
    
    {{-- Bottom Section (Original Wave 3.0 Structure) --}}
    <div class="flex-shrink-0 lg:h-[150px] flex border-t border-zinc-200 items-center w-full bg-white">
        <div class="grid h-auto grid-cols-1 px-8 py-10 mx-auto space-y-5 divide-y max-w-7xl lg:space-y-0 lg:divide-y-0 divide-zinc-200 lg:py-0 lg:divide-x md:px-12 lg:px-20 lg:divide-zinc-200 lg:grid-cols-3">
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

{{-- Additional CSS for enhanced styling --}}
<style>
    /* Smooth scroll behavior for anchor links */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom gradient animation for the background */
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Enhanced hover effects for buttons */
    .group:hover {
        transform: translateY(-2px);
    }
    
    /* Custom animation delays for floating elements */
    .animate-pulse.delay-1000 {
        animation-delay: 1s;
    }
    
    .animate-bounce.delay-500 {
        animation-delay: 0.5s;
    }
    
    /* Responsive text sizing improvements */
    @media (max-width: 640px) {
        .text-4xl {
            font-size: 2.5rem;
            line-height: 1.2;
        }
    }
</style>
