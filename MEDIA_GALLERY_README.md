# Media Carousel and Gallery System

## Overview
This system provides a comprehensive media carousel and gallery functionality for the CCB (Clubul Copiilor Botoșani) website, built with Wave 3.0 styling and Alpine.js/Livewire components.

## Components

### 1. Media Carousel (`media-carousel.blade.php`)
A responsive carousel component that displays both photos and videos with the following features:
- Automatic slideshow with configurable timing
- Manual navigation with arrows and dots
- Video support with play controls
- Responsive design
- Overlay content with action buttons
- Media type indicators

#### Usage:
```blade
<x-media-carousel 
    :items="$mediaItems"
    height="h-96 lg:h-[500px]"
    :autoplay="true"
    :autoplay-delay="5000"
    :show-dots="true"
    :show-arrows="true"
    :photo-gallery-route="'/galerie-foto'"
    :video-gallery-route="'/galerie-video'"
/>
```

### 2. MediaCarousel Livewire Component
Handles the backend logic for loading media files from storage:
- Scans multiple directories for media files
- Supports images: jpg, jpeg, png, gif, webp, svg
- Supports videos: mp4, webm, ogg, avi, mov, wmv
- Generates demo content when no media is found
- Configurable maximum items

### 3. Photo Gallery (`galerie-foto.blade.php`)
A dedicated photo gallery page with:
- Grid layout for photo thumbnails
- Modal view for full-size images
- Navigation between photos in modal
- Responsive design
- Loading states

### 4. Video Gallery (`galerie-video.blade.php`)
A dedicated video gallery page with:
- Grid layout for video thumbnails
- Modal video player
- Video controls and navigation
- Responsive design

## File Structure

```
/resources/themes/anchor/components/
├── media-carousel.blade.php          # Main carousel component

/app/Livewire/
├── MediaCarousel.php                 # Livewire component for carousel

/resources/views/livewire/
├── media-carousel.blade.php          # Livewire view

/resources/views/pages/
├── galerie-foto.blade.php            # Photo gallery page
├── galerie-video.blade.php           # Video gallery page

/app/Http/Controllers/
├── GalleryController.php             # Controller for gallery routes

/storage/app/public/gallery/
├── photos/                           # Photo storage directory
├── videos/                           # Video storage directory

/resources/themes/anchor/css/
├── gallery.css                       # Custom CSS for galleries
```

## Setup Instructions

### 1. Storage Setup
Make sure the storage symlink is created:
```bash
php artisan storage:link
```

### 2. Media Directories
Create the following directories in `/storage/app/public/`:
- `gallery/photos/` - for photo files
- `gallery/videos/` - for video files
- `media/photos/` - alternative photo directory
- `media/videos/` - alternative video directory

### 3. Upload Media Files
Place your media files in any of the supported directories:
- Images: jpg, jpeg, png, gif, webp, svg
- Videos: mp4, webm, ogg, avi, mov, wmv

### 4. Routes
The following routes are automatically registered:
- `/galerie-foto` - Photo gallery
- `/galerie-video` - Video gallery

### 5. Integration
The carousel is integrated into the hero section and can be added to any page:
```blade
@livewire('media-carousel')
```

## Customization

### Carousel Settings
Modify the Livewire component properties:
- `$maxItems` - Maximum number of items to display
- `$photoGalleryRoute` - Route for photo gallery
- `$videoGalleryRoute` - Route for video gallery

### Styling
Custom CSS is available in `/resources/themes/anchor/css/gallery.css`:
- Hover effects
- Animations
- Responsive adjustments
- Loading states

### Media Scanning
The system automatically scans these directories:
- `gallery/photos` and `gallery/videos`
- `media/photos` and `media/videos`
- `uploads`
- `public`

Add more directories by modifying the `$mediaPaths` array in `MediaCarousel.php`.

## Features

### Responsive Design
- Mobile-first approach
- Adaptive grid layouts
- Touch-friendly navigation
- Optimized loading

### Performance
- Lazy loading for images
- Efficient file scanning
- Caching considerations
- Optimized animations

### Accessibility
- Keyboard navigation support
- Screen reader friendly
- Focus management
- ARIA labels

### Browser Support
- Modern browsers with ES6+ support
- Alpine.js and Livewire compatibility
- Video format fallbacks

## Troubleshooting

### No Media Displayed
1. Check storage symlink: `ls -la public/storage`
2. Verify file permissions in storage directories
3. Ensure media files are in supported formats
4. Check Laravel logs for errors

### Videos Not Playing
1. Verify video format support (mp4 recommended)
2. Check file size limitations
3. Ensure proper MIME types are set
4. Test video files independently

### Carousel Not Working
1. Verify Alpine.js is loaded
2. Check browser console for JavaScript errors
3. Ensure Livewire is properly configured
4. Test with demo content first

## Adding New Features

### Custom Media Types
Add support for new file types by modifying the filter conditions in `MediaCarousel.php`.

### Additional Galleries
Create new gallery pages following the same pattern as photo/video galleries.

### Advanced Filtering
Implement category-based filtering by adding metadata to media items.

### Social Sharing
Add social media sharing buttons to gallery items.

This system provides a solid foundation for media management and can be extended based on specific requirements.
