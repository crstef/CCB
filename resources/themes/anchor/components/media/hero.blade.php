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

<section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-50 overflow-hidden">
    {{-- Background Decorative Elements --}}
    <div class="absolute inset-0 overflow-hidden">
        {{-- Floating geometric shapes for visual interest --}}
        <div class="absolute top-20 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-purple-200 rounded-full opacity-20 animate-bounce"></div>
        <div class="absolute bottom-40 left-20 w-24 h-24 bg-indigo-200 rounded-full opacity-20 animate-pulse delay-1000"></div>
        <div class="absolute bottom-20 right-10 w-18 h-18 bg-pink-200 rounded-full opacity-20 animate-bounce delay-500"></div>
        
        {{-- Gradient overlay for depth --}}
        <div class="absolute inset-0 bg-gradient-to-t from-white/10 via-transparent to-white/10"></div>
    </div>

    {{-- Main Content Container --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            
            {{-- Left Column: Media Carousel --}}
            <div class="w-full lg:w-1/2 order-2 lg:order-1">
                <div class="relative">
                    {{-- Section Title Above Carousel --}}
                    <div class="text-center lg:text-left mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Galeria Noastră</h3>
                        <p class="text-sm text-gray-600">Explorează momentele noastre speciale</p>
                    </div>
                    
                    {{-- Media Carousel Component --}}
                    {{-- This Livewire component handles media loading and display --}}
                    @livewire('media.media-carousel')
                    
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
            </div>

            {{-- Right Column: Main Content --}}
            <div class="w-full lg:w-1/2 order-1 lg:order-2 text-center lg:text-left">
                {{-- Main Heading --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    {{-- Primary title with gradient text effect --}}
                    <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        Bun venit la
                    </span>
                    <br>
                    {{-- Site name/brand --}}
                    <span class="text-gray-800">
                        {{ config('app.name', 'Wave') }}
                    </span>
                </h1>

                {{-- Description/Subtitle --}}
                <p class="text-xl md:text-2xl text-gray-600 mb-8 leading-relaxed max-w-2xl">
                    Descoperă o experiență unică în lumea digitală. Explorează galeria noastră de fotografii și videoclipuri captivante.
                </p>

                {{-- Feature Highlights --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    {{-- Feature 1: Photo Gallery --}}
                    <div class="flex items-center justify-center lg:justify-start">
                        <div class="flex items-center bg-blue-50 rounded-lg p-3">
                            <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-blue-700 font-medium">Galerie Foto Modernă</span>
                        </div>
                    </div>
                    
                    {{-- Feature 2: Video Gallery --}}
                    <div class="flex items-center justify-center lg:justify-start">
                        <div class="flex items-center bg-purple-50 rounded-lg p-3">
                            <svg class="w-6 h-6 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-purple-700 font-medium">Experiență Video HD</span>
                        </div>
                    </div>
                </div>

                {{-- Call-to-Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    {{-- Primary CTA Button --}}
                    <a href="#despre" 
                       class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <span>Descoperă Mai Mult</span>
                        {{-- Arrow icon with animation --}}
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    {{-- Secondary CTA Button --}}
                    <a href="#contact" 
                       class="group inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Contactează-ne</span>
                    </a>
                </div>

                {{-- Additional Info/Stats (Optional) --}}
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="grid grid-cols-3 gap-4 text-center lg:text-left">
                        {{-- Stat 1 --}}
                        <div>
                            <div class="text-2xl font-bold text-gray-900">500+</div>
                            <div class="text-sm text-gray-600">Fotografii</div>
                        </div>
                        {{-- Stat 2 --}}
                        <div>
                            <div class="text-2xl font-bold text-gray-900">50+</div>
                            <div class="text-sm text-gray-600">Videoclipuri</div>
                        </div>
                        {{-- Stat 3 --}}
                        <div>
                            <div class="text-2xl font-bold text-gray-900">1000+</div>
                            <div class="text-sm text-gray-600">Vizitatori</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
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
