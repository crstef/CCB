<div>
    <x-media-carousel 
        :items="$mediaItems"
        height="h-96 lg:h-[500px]"
        :autoplay="true"
        :autoplay-delay="5000"
        :show-dots="true"
        :show-arrows="true"
        :photo-gallery-route="$photoGalleryRoute"
        :video-gallery-route="$videoGalleryRoute"
    />
</div>
