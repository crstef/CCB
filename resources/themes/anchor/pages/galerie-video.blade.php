<x-layouts.marketing>
    <x-slot name="title">Galerie Video</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Galerie Video</h1>
        <p class="text-lg text-gray-600">Experimentează momentele speciale printr-un conținut video captivant</p>
    </div>

    @if($videos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($videos as $video)
                <div class="group relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-video overflow-hidden relative">
                        @if($video->isYouTube())
                            {{-- YouTube Video --}}
                            <div class="relative w-full h-full cursor-pointer youtube-video" 
                                 data-youtube-id="{{ $video->getYouTubeId() }}"
                                 onclick="playYouTubeVideo(this)">
                                <img 
                                    src="{{ $video->getYouTubeThumbnail() }}" 
                                    alt="{{ $video->title ?? 'Video YouTube' }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                />
                                
                                {{-- YouTube Play Button Overlay --}}
                                <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                                    <div class="bg-red-600 rounded-full p-4 shadow-lg group-hover:bg-red-700 transition-colors duration-300">
                                        <svg class="w-12 h-12 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                                
                                {{-- YouTube Logo --}}
                                <div class="absolute top-3 right-3 bg-white bg-opacity-90 rounded px-2 py-1">
                                    <span class="text-xs font-bold text-red-600">YouTube</span>
                                </div>
                            </div>
                        @else
                            {{-- Regular Video File --}}
                            <video 
                                src="{{ $video->url }}" 
                                class="w-full h-full object-cover"
                                controls
                                preload="metadata"
                            ></video>
                            
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-300 flex items-center justify-center">
                                <div class="bg-white bg-opacity-90 rounded-full p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-8 h-8 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    @if($video->title || $video->description)
                        <div class="p-4">
                            @if($video->title)
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $video->title }}</h3>
                            @endif
                            
                            @if($video->description)
                                <p class="text-sm text-gray-600">{{ $video->description }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Nu sunt videouri disponibile</h3>
            <p class="text-gray-600">Momentan nu există videouri în galerie.</p>
        </div>
    @endif
</div>

{{-- YouTube Video Modal --}}
<div id="youtubeModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 flex items-center justify-center p-4">
    <div class="relative max-w-6xl w-full">
        {{-- Close Button --}}
        <button 
            onclick="closeYouTubeModal()"
            class="absolute top-4 right-4 z-10 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-all"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        {{-- YouTube Iframe Container --}}
        <div class="aspect-video bg-black rounded-lg overflow-hidden">
            <iframe 
                id="youtubePlayer"
                width="100%" 
                height="100%" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>
        
        {{-- Video Info --}}
        <div class="mt-4 text-center text-white">
            <h3 id="videoTitle" class="text-xl font-semibold mb-2"></h3>
            <p id="videoDescription" class="text-gray-300"></p>
        </div>
    </div>
</div>

<script>
function playYouTubeVideo(element) {
    const youtubeId = element.getAttribute('data-youtube-id');
    const modal = document.getElementById('youtubeModal');
    const iframe = document.getElementById('youtubePlayer');
    const titleElement = document.getElementById('videoTitle');
    const descElement = document.getElementById('videoDescription');
    
    // Get video info from the card
    const videoCard = element.closest('.group');
    const title = videoCard.querySelector('h3')?.textContent || 'Video YouTube';
    const description = videoCard.querySelector('p')?.textContent || '';
    
    // Set video info
    titleElement.textContent = title;
    descElement.textContent = description;
    
    // Set YouTube embed URL with autoplay
    iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0&modestbranding=1`;
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeYouTubeModal() {
    const modal = document.getElementById('youtubeModal');
    const iframe = document.getElementById('youtubePlayer');
    
    // Stop video by removing src
    iframe.src = '';
    
    // Hide modal
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside or pressing Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeYouTubeModal();
    }
});

document.getElementById('youtubeModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeYouTubeModal();
    }
});
</script>

<style>
.youtube-video {
    transition: transform 0.3s ease;
}

.youtube-video:hover {
    transform: scale(1.02);
}

/* Custom scrollbar for webkit browsers */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
</x-layouts.marketing>
