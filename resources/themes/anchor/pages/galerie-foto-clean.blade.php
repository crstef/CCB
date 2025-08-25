<?php
use Illuminate\View\View;
use function Laravel\Folio\name;

name('galerie-foto');
?>

<x-layouts.marketing>
    <x-slot name="title">Galerie Foto - Competiții Canine CCB</x-slot>
    <x-slot name="description">Galeria foto oficială a Clubului Ciobanesc Belgian România - fotografii din competiții canine, campionate naționale și internaționale.</x-slot>
    
    <style>
        /* Simple Gallery Styles */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            aspect-ratio: 4/3;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            background: #f8fafc;
        }
        
        .gallery-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        
        .gallery-overlay {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 1rem;
            min-height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-overlay h3 {
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
        }
        
        .gallery-overlay p {
            color: rgba(255,255,255,0.9);
            font-size: 0.75rem;
            line-height: 1.4;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
        }
        
        /* Lightbox Styles */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            backdrop-filter: blur(4px);
        }
        
        .lightbox.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-image {
            width: 100%;
            height: auto;
            max-height: 70vh;
            object-fit: contain;
            display: block;
        }
        
        .lightbox-info {
            padding: 1.5rem;
            background: white;
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 3rem;
            height: 3rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }
        
        .lightbox-nav:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }
        
        .lightbox-prev {
            left: 2rem;
        }
        
        .lightbox-next {
            right: 2rem;
        }
        
        .lightbox-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(0, 0, 0, 0.7);
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }
        
        .lightbox-close:hover {
            background: rgba(0, 0, 0, 0.9);
        }
        
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1rem;
            }
            
            .lightbox-content {
                max-width: 95vw;
                max-height: 95vh;
            }
            
            .lightbox-image {
                max-height: 60vh;
            }
            
            .lightbox-info {
                padding: 1rem;
            }
            
            .lightbox-nav {
                width: 2.5rem;
                height: 2.5rem;
            }
            
            .lightbox-prev {
                left: 1rem;
            }
            
            .lightbox-next {
                right: 1rem;
            }
        }
    </style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Discrete Header -->
    <div class="bg-white/80 backdrop-blur-sm border-b border-gray-200/50 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span class="text-sm font-medium">Înapoi la pagina principală</span>
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Galerie Foto</h1>
                <div class="text-sm text-gray-500">
                    {{ $photos->count() }} fotografii
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($photos->count() > 0)
            <div class="gallery-grid" id="galleryGrid">
                @foreach($photos as $index => $photo)
                    <div class="gallery-item" 
                         data-index="{{ $index }}"
                         onclick="openLightbox({{ $index }})">
                        <img 
                            src="{{ $photo->url }}" 
                            alt="{{ $photo->title ?? 'Fotografie competiție canină' }}"
                            loading="lazy"
                        />
                        
                        <div class="gallery-overlay">
                            @if($photo->title)
                                <h3>{{ $photo->title }}</h3>
                            @endif
                            
                            @if($photo->description)
                                <p>{{ Str::limit($photo->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Galeria se încarcă...</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Pregătim cele mai spectaculoase fotografii din competițiile canine pentru tine.
                </p>
            </div>
        @endif
    </div>
</div>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <button class="lightbox-nav lightbox-prev" onclick="prevImage()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    
    <button class="lightbox-nav lightbox-next" onclick="nextImage()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    
    <div class="lightbox-content">
        <img class="lightbox-image" id="lightboxImage" src="" alt="" />
        <div class="lightbox-info">
            <h3 class="text-xl font-bold text-gray-900 mb-2" id="lightboxTitle"></h3>
            <p class="text-gray-600 mb-4 leading-relaxed" id="lightboxDescription"></p>
            <div class="flex items-center justify-between text-sm text-gray-500 pt-4 border-t border-gray-200">
                <span id="lightboxDate"></span>
                <span class="text-blue-600 font-medium">📸 Galerie CCB România</span>
            </div>
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let allPhotos = @json($photos->values()->all());

function openLightbox(index) {
    currentImageIndex = index;
    updateLightboxContent();
    
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.remove('active');
    document.body.style.overflow = 'auto';
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + allPhotos.length) % allPhotos.length;
    updateLightboxContent();
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % allPhotos.length;
    updateLightboxContent();
}

function updateLightboxContent() {
    const photo = allPhotos[currentImageIndex];
    
    if (!photo) return;
    
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDescription = document.getElementById('lightboxDescription');
    const lightboxDate = document.getElementById('lightboxDate');
    
    lightboxImage.src = photo.url;
    lightboxImage.alt = photo.title || 'Fotografie competiție canină';
    lightboxTitle.textContent = photo.title || 'Competiție Canină';
    lightboxDescription.textContent = photo.description || 'Fotografie din competițiile canine organizate de Clubul Ciobanescului Belgian România.';
    lightboxDate.textContent = photo.created_at ? 
        new Date(photo.created_at).toLocaleDateString('ro-RO', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric' 
        }) : 'Recent';
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('lightbox').classList.contains('active')) {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                prevImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    }
});

// Close lightbox when clicking outside
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Touch/swipe support for mobile
let touchStartX = 0;
let touchEndX = 0;

document.getElementById('lightbox').addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
});

document.getElementById('lightbox').addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            nextImage();
        } else {
            prevImage();
        }
    }
}
</script>

</x-layouts.marketing>
