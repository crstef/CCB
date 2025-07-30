{{--
    Livewire Media Carousel View
    
    This is the Livewire component view that connects the MediaCarousel PHP component
    with the media-carousel Blade component. It serves as a bridge between the
    backend logic and the frontend display.
    
    The component displays:
    - Media carousel with auto-playing slides
    - Gallery statistics (image/video counts)
    - Navigation to dedicated gallery pages
    
    @var array $items - Media items from the Livewire component
    @var int $imageCount - Number of images in the collection
    @var int $videoCount - Number of videos in the collection
    @var int $totalCount - Total number of media items
--}}

<div>
    {{-- Media Carousel Component --}}
    {{-- Include the reusable carousel component with data from Livewire --}}
    <x-media.carousel.media-carousel 
        :items="$items"
        height="h-96"
        :autoplay="true"
        :autoplayDelay="5000"
        :showDots="true"
        :showArrows="true"
        photoGalleryRoute="/galerie-foto"
        videoGalleryRoute="/galerie-video"
    />
    
    {{-- Gallery Statistics (Optional) --}}
    {{-- Uncomment this section if you want to show media statistics --}}
    {{--
    <div class="mt-4 flex justify-center space-x-6 text-sm text-gray-600">
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>{{ $imageCount }} Fotografii</span>
        </div>
        
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <span>{{ $videoCount }} Videoclipuri</span>
        </div>
        
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span>{{ $totalCount }} Total</span>
        </div>
    </div>
    --}}
    
    {{-- Refresh Button (for development/admin use) --}}
    {{-- Uncomment this section if you want a manual refresh button --}}
    {{--
    <div class="mt-4 text-center">
        <button 
            wire:click="refreshMedia" 
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
        >
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Actualizează Media
        </button>
    </div>
    --}}
</div>
