<x-layouts.marketing>
    <x-slot name="title">Galerie Video</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Galerie Video</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Explorează colecția noastră de videoclipuri din competiții, antrenamente și evenimente speciale ale Clubului Ciobănescilor Belgieni
        </p>
    </div>

    <!-- Category Filter -->
    <div class="mb-8">
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('galerie-video') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ !$selectedCategory ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Toate
            </a>
            @foreach($categories as $key => $label)
                <a href="{{ route('galerie-video', ['category' => $key]) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $selectedCategory === $key ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    @if($videos->count() > 0)
        <!-- Videos Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="videoGrid">
            @foreach($videos as $video)
                <div class="group relative bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105" 
                     data-video-id="{{ $video->id }}"
                     data-video-type="{{ $video->video_source }}">
                    
                    <!-- Video Thumbnail -->
                    <div class="aspect-video overflow-hidden relative cursor-pointer"
                         onclick="openVideoModal({{ $video->id }}, '{{ $video->video_source }}', '{{ addslashes($video->title) }}')">
                        
                        @if($video->isYouTubeVideo())
                            {{-- YouTube Video Thumbnail --}}
                            <img 
                                src="{{ $video->getVideoThumbnail() }}" 
                                alt="{{ $video->title ?? 'Video YouTube' }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                loading="lazy"
                            />
                            
                            {{-- YouTube Play Button Overlay --}}
                            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center group-hover:bg-opacity-20 transition-all duration-300">
                                <div class="bg-red-600 rounded-full p-4 shadow-xl group-hover:bg-red-700 group-hover:scale-110 transition-all duration-300">
                                    <svg class="w-12 h-12 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            {{-- YouTube Badge --}}
                            <div class="absolute top-3 right-3 bg-red-600 text-white rounded-full px-3 py-1 text-xs font-bold shadow-lg">
                                YouTube
                            </div>
                        @else
                            {{-- Local Video Thumbnail --}}
                            <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <div class="bg-blue-600 rounded-full p-4 mx-auto mb-3">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm opacity-75">Video Local</p>
                                </div>
                            </div>
                            
                            {{-- Local Video Badge --}}
                            <div class="absolute top-3 right-3 bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-bold shadow-lg">
                                Local
                            </div>
                        @endif

                        {{-- Duration Badge --}}
                        @if($video->getFormattedDuration())
                            <div class="absolute bottom-3 right-3 bg-black bg-opacity-75 text-white rounded px-2 py-1 text-xs font-medium">
                                {{ $video->getFormattedDuration() }}
                            </div>
                        @endif

                        {{-- Category Badge --}}
                        @if($video->video_category)
                            <div class="absolute top-3 left-3 bg-white bg-opacity-90 text-gray-800 rounded-full px-3 py-1 text-xs font-medium">
                                {{ $categories[$video->video_category] ?? $video->video_category }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $video->title ?? 'Video fără titlu' }}
                        </h3>
                        
                        @if($video->description)
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ $video->description }}
                            </p>
                        @endif

                        <!-- Video Metadata -->
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center space-x-4">
                                @if($video->video_category)
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"/>
                                        </svg>
                                        {{ $categories[$video->video_category] ?? $video->video_category }}
                                    </span>
                                @endif
                                
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z"/>
                                    </svg>
                                    {{ $video->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <button onclick="openVideoModal({{ $video->id }}, '{{ $video->video_source }}', '{{ addslashes($video->title) }}')"
                                    class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                                Vizionează →
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">
                @if($selectedCategory)
                    Nu există videoclipuri în categoria "{{ $categories[$selectedCategory] ?? $selectedCategory }}"
                @else
                    Nu există videoclipuri disponibile
                @endif
            </h3>
            <p class="text-gray-600 mb-6">
                @if($selectedCategory)
                    Încearcă să explorezi alte categorii sau revino mai târziu.
                @else
                    Videoclipurile vor fi adăugate în curând. Încearcă să revii mai târziu.
                @endif
            </p>
            @if($selectedCategory)
                <a href="{{ route('galerie-video') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    Vezi toate videoclipurile
                </a>
            @endif
        </div>
    @endif
</div>

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-900">Video</h3>
                <button onclick="closeVideoModal()" 
                        class="text-gray-400 hover:text-gray-600 transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="p-6">
                <div id="videoContainer" class="aspect-video rounded-lg overflow-hidden bg-gray-900">
                    <!-- Video will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
// Video modal functionality
function openVideoModal(videoId, videoSource, videoTitle) {
    const modal = document.getElementById('videoModal');
    const modalTitle = document.getElementById('modalTitle');
    const videoContainer = document.getElementById('videoContainer');
    
    // Set modal title
    modalTitle.textContent = videoTitle;
    
    // Get video data
    fetch(`/api/media/${videoId}`)
        .then(response => response.json())
        .then(data => {
            let videoHtml = '';
            
            if (videoSource === 'youtube' && data.youtube_id) {
                // YouTube embed
                videoHtml = `
                    <iframe 
                        width="100%" 
                        height="100%" 
                        src="https://www.youtube.com/embed/${data.youtube_id}?autoplay=1&rel=0&modestbranding=1" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                        class="rounded-lg">
                    </iframe>
                `;
            } else if (videoSource === 'local' && data.file_path) {
                // Local video
                videoHtml = `
                    <video 
                        width="100%" 
                        height="100%" 
                        controls 
                        autoplay
                        class="rounded-lg">
                        <source src="${data.url}" type="${data.mime_type}">
                        Browser-ul dumneavoastră nu suportă redarea video-ului.
                    </video>
                `;
            } else {
                videoHtml = `
                    <div class="flex items-center justify-center h-full text-white">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z"/>
                            </svg>
                            <p>Nu se poate încărca videoclipul</p>
                        </div>
                    </div>
                `;
            }
            
            videoContainer.innerHTML = videoHtml;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        })
        .catch(error => {
            console.error('Error loading video:', error);
            videoContainer.innerHTML = `
                <div class="flex items-center justify-center h-full text-white">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z"/>
                        </svg>
                        <p>Eroare la încărcarea videoclipului</p>
                    </div>
                </div>
            `;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
}

function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const videoContainer = document.getElementById('videoContainer');
    
    // Clear video content to stop playback
    videoContainer.innerHTML = '';
    
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside
document.getElementById('videoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVideoModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeVideoModal();
    }
});

// Smooth scroll to video after category filter
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('category')) {
    setTimeout(() => {
        document.getElementById('videoGrid')?.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
    }, 100);
}
</script>

</x-layouts.marketing>
