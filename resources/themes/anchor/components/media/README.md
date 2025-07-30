# Wave 3.0 Media Gallery System

A comprehensive media gallery system built for the Wave 3.0 framework, featuring responsive image and video galleries with modern UI components and excellent user experience.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [File Structure](#file-structure)
- [Installation](#installation)
- [Usage](#usage)
- [Components](#components)
- [Configuration](#configuration)
- [Customization](#customization)
- [Browser Support](#browser-support)
- [Contributing](#contributing)

## 🎯 Overview

The Wave 3.0 Media Gallery System provides a complete solution for displaying photos and videos on your website. It includes:

- **Auto-playing carousel** with manual navigation
- **Dedicated gallery pages** for photos and videos
- **Modal lightbox viewers** with keyboard navigation
- **Responsive design** that works on all devices
- **Modern animations** and smooth transitions
- **Accessibility features** for screen readers
- **Touch/swipe support** for mobile devices

## ✨ Features

### Media Carousel
- ✅ Auto-playing slideshow with configurable timing
- ✅ Manual navigation with arrow buttons and dot indicators
- ✅ Support for both images and videos
- ✅ Overlay content with call-to-action buttons
- ✅ Media type indicators (Photo/Video badges)
- ✅ Pause on hover functionality
- ✅ Smooth transitions and animations

### Photo Gallery
- ✅ Responsive masonry-style grid layout
- ✅ Modal lightbox for full-size viewing
- ✅ Keyboard navigation (arrow keys, escape)
- ✅ Touch/swipe support for mobile devices
- ✅ Image lazy loading for performance
- ✅ Search and filter functionality (optional)

### Video Gallery
- ✅ Responsive grid layout optimized for video content
- ✅ Modal video player with controls
- ✅ Keyboard navigation (arrow keys, escape, space for play/pause)
- ✅ Thumbnail preview with play buttons
- ✅ Full-screen video viewing capability
- ✅ Video duration indicators

### Technical Features
- ✅ Built with Laravel Livewire for reactive components
- ✅ Alpine.js for frontend interactivity
- ✅ Tailwind CSS for styling
- ✅ File type auto-detection
- ✅ Storage directory scanning
- ✅ Demo content generation
- ✅ Comprehensive error handling

## 📁 File Structure

```
/workspaces/CCB/
├── app/
│   └── Livewire/
│       └── Media/
│           └── MediaCarousel.php              # Main Livewire component
├── resources/
│   ├── themes/anchor/components/media/
│   │   ├── carousel/
│   │   │   └── media-carousel.blade.php       # Carousel component
│   │   ├── galleries/
│   │   │   ├── photo-gallery.blade.php        # Photo gallery component (optional)
│   │   │   └── video-gallery.blade.php        # Video gallery component (optional)
│   │   ├── styles/
│   │   │   └── gallery.css                    # Media system styles
│   │   └── hero.blade.php                     # Enhanced hero section
│   ├── views/
│   │   ├── livewire/media/carousel/
│   │   │   └── media-carousel.blade.php       # Livewire component view
│   │   └── pages/media/
│   │       ├── galerie-foto.blade.php         # Photo gallery page
│   │       └── galerie-video.blade.php        # Video gallery page
│   └── css/
│       └── media-gallery.css                  # Compiled styles (optional)
├── storage/app/public/
│   ├── gallery/
│   │   ├── photos/                            # Photo storage directory
│   │   └── videos/                            # Video storage directory
│   └── media/
│       ├── images/                            # Alternative image directory
│       └── videos/                            # Alternative video directory
└── routes/
    └── web.php                                # Gallery routes (add manually)
```

## 🚀 Installation

### 1. Prerequisites

Ensure you have a Wave 3.0 installation with:
- Laravel 12.21.0+
- PHP 8.4.8+
- Livewire 3.x
- Alpine.js
- Tailwind CSS

### 2. File Setup

All the necessary files have been created in the organized folder structure. The system is ready to use with the following components:

- ✅ Livewire MediaCarousel component
- ✅ Blade carousel component
- ✅ Photo gallery page
- ✅ Video gallery page
- ✅ Enhanced hero section
- ✅ Comprehensive CSS styles

### 3. Routes Configuration

Add these routes to your `routes/web.php` file:

```php
// Media Gallery Routes
Route::get('/galerie-foto', function () {
    return view('pages.media.galerie-foto');
})->name('gallery.photos');

Route::get('/galerie-video', function () {
    return view('pages.media.galerie-video');
})->name('gallery.videos');
```

### 4. Storage Setup

Create the storage directories:

```bash
mkdir -p storage/app/public/gallery/photos
mkdir -p storage/app/public/gallery/videos
mkdir -p storage/app/public/media/images
mkdir -p storage/app/public/media/videos
```

Ensure the storage symlink is created:

```bash
php artisan storage:link
```

### 5. CSS Integration

Include the gallery styles in your main CSS file or add to your Tailwind configuration:

```html
<!-- In your layout file -->
<link rel="stylesheet" href="{{ asset('themes/anchor/components/media/styles/gallery.css') }}">
```

## 📖 Usage

### Basic Carousel Usage

Include the carousel in any Blade template:

```blade
{{-- Basic carousel --}}
@livewire('media.media-carousel')

{{-- Carousel with custom options --}}
<x-media.carousel.media-carousel 
    :items="$mediaItems"
    height="h-96"
    :autoplay="true"
    :autoplayDelay="5000"
    :showDots="true"
    :showArrows="true"
    photoGalleryRoute="/galerie-foto"
    videoGalleryRoute="/galerie-video"
/>
```

### Hero Section Integration

Replace your existing hero section with the enhanced version:

```blade
@include('theme::components.media.hero')
```

### Gallery Pages

The gallery pages are accessible at:
- `/galerie-foto` - Photo gallery with lightbox viewer
- `/galerie-video` - Video gallery with modal player

## 🧩 Components

### 1. MediaCarousel (Livewire Component)

**Location:** `app/Livewire/Media/MediaCarousel.php`

**Purpose:** Handles backend logic for media loading and processing.

**Key Methods:**
- `loadMediaItems()` - Scans storage for media files
- `processMediaFiles()` - Converts files to carousel items
- `generateDemoContent()` - Creates placeholder content
- `refreshMedia()` - Reloads media from storage

**Configuration:**
```php
// Maximum items to display
public $maxItems = 10;

// Supported file extensions
protected $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
protected $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv'];

// Storage paths to scan
protected $mediaPaths = [
    'gallery/photos',
    'gallery/videos',
    'media/images',
    'media/videos',
    'uploads/gallery'
];
```

### 2. Media Carousel Component

**Location:** `resources/themes/anchor/components/media/carousel/media-carousel.blade.php`

**Purpose:** Frontend carousel display with Alpine.js interactivity.

**Features:**
- Auto-playing slideshow
- Manual navigation
- Responsive design
- Media type detection
- Overlay content

**Props:**
- `items` - Array of media items
- `height` - CSS height classes
- `autoplay` - Enable auto-playing
- `autoplayDelay` - Time between slides
- `showDots` - Show dot navigation
- `showArrows` - Show arrow buttons

### 3. Gallery Pages

**Photo Gallery:** `resources/views/pages/media/galerie-foto.blade.php`
**Video Gallery:** `resources/views/pages/media/galerie-video.blade.php`

**Features:**
- Responsive grid layout
- Modal viewers
- Keyboard navigation
- Touch support
- Loading states

## ⚙️ Configuration

### Carousel Settings

Customize the carousel behavior by modifying the Livewire component properties:

```php
// In MediaCarousel.php
public $maxItems = 20;           // Increase max items
public $autoplayDelay = 3000;    // Faster transitions
```

### Storage Paths

Add custom storage paths by updating the `$mediaPaths` array:

```php
protected $mediaPaths = [
    'gallery/photos',
    'gallery/videos',
    'uploads/custom',
    'media/portfolio',
    // Add your custom paths
];
```

### Supported File Types

Extend supported file types by modifying the extension arrays:

```php
protected $imageExtensions = [
    'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp',
    'tiff', 'ico', 'avif'  // Add new formats
];

protected $videoExtensions = [
    'mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv',
    'mkv', 'flv', '3gp'    // Add new formats
];
```

## 🎨 Customization

### Styling

The system uses a comprehensive CSS file with organized sections:

1. **Global Media Styles** - Base styles and scrollbars
2. **Media Carousel Styles** - Carousel-specific styling
3. **Gallery Grid Styles** - Grid layout and item styling
4. **Modal Styles** - Lightbox and video player styling
5. **Hero Section Enhancements** - Hero-specific improvements
6. **Utility Classes** - Reusable helper classes
7. **Responsive Design** - Mobile/tablet/desktop optimizations
8. **Accessibility Enhancements** - A11y improvements

### Custom Themes

Create custom themes by overriding CSS variables:

```css
:root {
    --carousel-border-radius: 1rem;
    --gallery-item-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --modal-backdrop: rgba(0, 0, 0, 0.95);
    --transition-duration: 0.3s;
}
```

### Component Variants

Create component variants by extending the base components:

```blade
{{-- Custom carousel variant --}}
<x-media.carousel.media-carousel 
    :items="$items"
    height="h-screen"
    :autoplay="false"
    class="custom-carousel-variant"
/>
```

## 🌐 Browser Support

The media gallery system supports:

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile Safari (iOS 14+)
- ✅ Chrome Mobile (Android 10+)

### Progressive Enhancement

The system provides fallbacks for:
- Browsers without Alpine.js support
- Disabled JavaScript environments
- Slow network connections
- Reduced motion preferences

## 🔧 Troubleshooting

### Common Issues

**1. Images not displaying:**
- Check storage symlink: `php artisan storage:link`
- Verify file permissions: `chmod -R 755 storage/app/public`
- Ensure storage directories exist

**2. Carousel not auto-playing:**
- Check Alpine.js is loaded
- Verify no JavaScript errors in console
- Check autoplay prop is set to true

**3. Modal not opening:**
- Ensure Alpine.js is loaded
- Check for CSS conflicts
- Verify click handlers are attached

**4. Videos not playing:**
- Check video file formats are supported
- Verify MIME types are correct
- Ensure videos are properly encoded

### Debug Mode

Enable debug mode in the Livewire component:

```php
// Add to MediaCarousel.php
public function mount()
{
    if (config('app.debug')) {
        \Log::info('MediaCarousel: Loading media items');
    }
    $this->loadMediaItems();
}
```

## 📱 Mobile Optimization

The system includes comprehensive mobile optimizations:

- **Touch/Swipe Support** - Navigate carousel and modals with gestures
- **Responsive Grid** - Adaptive layouts for all screen sizes
- **Performance** - Lazy loading and optimized images
- **Accessibility** - Screen reader support and keyboard navigation

### Mobile-Specific Features

- Optimized touch targets (minimum 44px)
- Swipe gesture recognition
- Reduced animation complexity
- Compressed image variants
- Touch-friendly modal controls

## 🚀 Performance

### Optimization Features

- **Lazy Loading** - Images load only when needed
- **File Compression** - Automatic image optimization
- **Caching** - Browser and server-side caching
- **CDN Ready** - Easy integration with CDNs
- **Minimal JavaScript** - Lightweight Alpine.js usage

### Performance Tips

1. **Optimize Images:**
   ```bash
   # Use image optimization tools
   imagemin gallery/photos/*.jpg --out-dir=gallery/photos/optimized
   ```

2. **Enable Browser Caching:**
   ```apache
   # Add to .htaccess
   <IfModule mod_expires.c>
       ExpiresActive on
       ExpiresByType image/jpg "access plus 1 month"
       ExpiresByType image/jpeg "access plus 1 month"
       ExpiresByType image/png "access plus 1 month"
       ExpiresByType video/mp4 "access plus 1 month"
   </IfModule>
   ```

3. **Use CDN for Media:**
   ```php
   // In MediaCarousel.php
   protected function generateUrl($file)
   {
       if (config('filesystems.cdn_enabled')) {
           return config('filesystems.cdn_url') . '/' . $file;
       }
       return Storage::disk('public')->url($file);
   }
   ```

## 🤝 Contributing

We welcome contributions to improve the media gallery system! Here's how you can help:

### Development Setup

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

### Coding Standards

- Follow PSR-12 coding standards
- Use meaningful variable names
- Add comprehensive comments
- Include error handling
- Write tests for new features

### Testing

Run the test suite before submitting:

```bash
php artisan test --filter=MediaGallery
```

## 📄 License

This media gallery system is part of the Wave 3.0 framework and follows the same licensing terms.

## 📞 Support

For support and questions:

- **Documentation:** Check the Wave 3.0 documentation
- **Issues:** Report bugs via the issue tracker
- **Community:** Join the Wave community forums
- **Professional Support:** Contact the Wave team

---

**Built with ❤️ for the Wave 3.0 Framework**

*Last updated: January 2025*
