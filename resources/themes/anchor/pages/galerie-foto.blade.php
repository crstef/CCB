<?php
use Illuminate\View\View;
use function Laravel\Folio\name;

name('galerie-foto');
?>

<x-layouts.marketing>
    <x-slot name="title">Galerie Foto - Competiții Canine CCB</x-slot>
    <x-slot name="description">Galeria foto oficială a Clubului Ciobanesc Belgian România - fotografii din competiții canine, campionate naționale și internaționale.</x-slot>
    
    <!-- Modern Gallery Styles -->
    <style>
        /* Custom lightbox and gallery styles */
        .gallery-grid {
            display: grid;
             // Remove loading state when image loads
    lightboxImage.onload = function() {
        console.log('Image loaded successfully');
        this.style.opacity = '1';
        this.style.filter = 'none';
    };
    
    // Handle image load errors
    lightboxImage.onerror = function() {
        console.error('Failed to load image:', photo.url);
        this.style.opacity = '1';
        this.style.filter = 'none';
        this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk0YTNiOCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkVyb2FyZSBpbWFnaW5lPC90ZXh0Pjwvc3ZnPic;
    };ate-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            aspect-ratio: 4/3;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background: #f8fafc;
        }
        
        .gallery-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.8) 50%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.5rem;
            min-height: 80px;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            backdrop-filter: blur(8px);
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
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transform: scale(0.9);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .lightbox.active .lightbox-content {
            transform: scale(1);
            opacity: 1;
        }
        
        .lightbox-image {
            width: 100%;
            height: auto;
            max-height: 60vh;
            object-fit: contain;
            display: block;
            flex-shrink: 0;
        }
        
        .lightbox-info {
            padding: 1.5rem;
            background: white;
            flex-grow: 1;
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 3.5rem;
            height: 3.5rem;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
            z-index: 10;
        }
        
        .lightbox-nav:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        }
        
        .lightbox-prev {
            left: 2rem;
        }
        
        .lightbox-next {
            right: 2rem;
        }
        
        .lightbox-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 3rem;
            height: 3rem;
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
            transform: scale(1.1);
        }
        
        .zoom-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover .zoom-icon {
            opacity: 1;
            transform: scale(1);
        }
        
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
            }
            
            .lightbox-content {
                max-width: 95vw;
                max-height: 95vh;
            }
            
            .lightbox-image {
                max-height: 50vh;
            }
            
            .lightbox-info {
                padding: 1rem;
            }
            
            .lightbox-nav {
                width: 3rem;
                height: 3rem;
            }
            
            .lightbox-prev {
                left: 1rem;
            }
            
            .lightbox-next {
                right: 1rem;
            }
            
            .gallery-overlay {
                padding: 1rem;
            }
        }
        
        /* Loading animation */
        .loading-spinner {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            border: 3px solid #f3f4f6;
            border-radius: 50%;
            border-top-color: #3b82f6;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Fade in animation for gallery items */
        .gallery-item {
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .gallery-item:nth-child(1) { animation-delay: 0.1s; }
        .gallery-item:nth-child(2) { animation-delay: 0.2s; }
        .gallery-item:nth-child(3) { animation-delay: 0.3s; }
        .gallery-item:nth-child(4) { animation-delay: 0.4s; }
        .gallery-item:nth-child(5) { animation-delay: 0.5s; }
        .gallery-item:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 3rem;
            height: 3rem;
            background: rgba(59, 130, 246, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            z-index: 1000;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .scroll-to-top:hover {
            background: rgba(59, 130, 246, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }
        
        @media (max-width: 768px) {
            .scroll-to-top {
                bottom: 1.5rem;
                right: 1.5rem;
                width: 2.5rem;
                height: 2.5rem;
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
                            onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk0YTNiOCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkZvdG9ncmFmaWU8L3RleHQ+PC9zdmc+'"
                        />
                        
                        <div class="zoom-icon">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                        
                        <div class="gallery-overlay">
                            @if($photo->title || $photo->description)
                                @if($photo->title)
                                    <h3 class="text-white font-bold text-sm mb-1 drop-shadow-lg" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                                        {{ $photo->title }}
                                    </h3>
                                @endif
                                
                                @if($photo->description)
                                    <p class="text-white text-xs leading-relaxed drop-shadow-lg" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">
                                        {{ Str::limit($photo->description, 80) }}
                                    </p>
                                @endif
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
                <div class="flex items-center justify-center space-x-4">
                    <div class="loading-spinner"></div>
                    <span class="text-gray-500">Se încarcă fotografiile...</span>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Scroll to Top Button -->
<button class="scroll-to-top" id="scrollToTop" onclick="scrollToTop()">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <button class="lightbox-nav lightbox-prev" onclick="prevImage()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    
    <button class="lightbox-nav lightbox-next" onclick="nextImage()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    
    <div class="lightbox-content">
        <img class="lightbox-image" id="lightboxImage" src="" alt="" />
        <div class="lightbox-info">
            <h3 class="text-2xl font-bold text-gray-900 mb-3" id="lightboxTitle"></h3>
            <p class="text-gray-600 mb-4 leading-relaxed" id="lightboxDescription"></p>
            <div class="flex items-center justify-between text-sm text-gray-500 pt-4 border-t border-gray-200">
                <span id="lightboxDate"></span>
                <div class="flex items-center space-x-4">
                    <span class="text-blue-600 font-medium">📸 Galerie CCB România</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let allPhotos = @json($photos->values()->all());

// Debug: check photos data
console.log('Photos data:', allPhotos);

function openLightbox(index) {
    console.log('Opening lightbox for index:', index, 'Photo:', allPhotos[index]);
    currentImageIndex = index;
    updateLightboxContent();
    
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Add smooth entrance animation
    setTimeout(() => {
        lightbox.querySelector('.lightbox-content').style.transform = 'scale(1)';
        lightbox.querySelector('.lightbox-content').style.opacity = '1';
    }, 50);
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    const content = lightbox.querySelector('.lightbox-content');
    
    // Add smooth exit animation
    content.style.transform = 'scale(0.9)';
    content.style.opacity = '0';
    
    setTimeout(() => {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
    }, 300);
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
    console.log('Updating lightbox content with photo:', photo);
    
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDescription = document.getElementById('lightboxDescription');
    const lightboxDate = document.getElementById('lightboxDate');
    
    if (!photo || !photo.url) {
        console.error('Invalid photo data:', photo);
        return;
    }
    
    // Add loading state
    lightboxImage.style.opacity = '0.3';
    lightboxImage.style.filter = 'blur(2px)';
    
    // Clear previous src to force reload
    lightboxImage.src = '';
    
    // Set new image source
    console.log('Setting image src to:', photo.url);
    lightboxImage.src = photo.url;
    lightboxImage.alt = photo.title || 'Fotografie competiție canină';
    
    // Update text content
    lightboxTitle.textContent = photo.title || 'Competiție Canină';
    lightboxDescription.textContent = photo.description || 'Fotografie din competițiile canine organizate de Clubul Ciobanescului Belgian România.';
    lightboxDate.textContent = photo.created_at ? 
        new Date(photo.created_at).toLocaleDateString('ro-RO', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric' 
        }) : 'Recent';
    
    // Remove loading state when image loads
    lightboxImage.onload = function() {
        this.style.opacity = '1';
        this.style.filter = 'none';
    };
    
    // Handle image load errors
    lightboxImage.onerror = function() {
        this.style.opacity = '1';
        this.style.filter = 'none';
        console.error('Failed to load image:', photo.url);
        this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk0YTNiOCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkVyb2FyZSBpbWFnaW5lPC90ZXh0Pjwvc3ZnPic7
    };
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
            nextImage(); // Swipe left - next image
        } else {
            prevImage(); // Swipe right - previous image
        }
    }
}

// Preload adjacent images for smoother experience
function preloadImage(index) {
    if (allPhotos[index]) {
        const img = new Image();
        img.src = allPhotos[index].url;
    }
}

// Preload next and previous images when lightbox opens
function preloadAdjacentImages() {
    const prevIndex = (currentImageIndex - 1 + allPhotos.length) % allPhotos.length;
    const nextIndex = (currentImageIndex + 1) % allPhotos.length;
    
    preloadImage(prevIndex);
    preloadImage(nextIndex);
}

// Call preload when lightbox content updates
const originalUpdateLightboxContent = updateLightboxContent;
updateLightboxContent = function() {
    originalUpdateLightboxContent();
    preloadAdjacentImages();
};

// Scroll to top functionality
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Show/hide scroll to top button
window.addEventListener('scroll', function() {
    const scrollButton = document.getElementById('scrollToTop');
    if (window.pageYOffset > 300) {
        scrollButton.classList.add('visible');
    } else {
        scrollButton.classList.remove('visible');
    }
});
</script>

</x-layouts.marketing>
