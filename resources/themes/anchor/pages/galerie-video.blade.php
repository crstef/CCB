@layout('theme::layouts.app')

@section('title', 'Galerie Video')

@section('content')
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
@endsection
