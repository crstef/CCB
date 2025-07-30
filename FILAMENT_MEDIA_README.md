# 📸 Filament Media Management System

Complete backend media management system for Wave 3.0 with Filament admin interface.

## 🚀 Features

### ✅ **Admin Interface**
- **Upload Management**: Drag & drop file uploads with preview
- **Advanced Filtering**: Filter by type, category, visibility, featured status
- **Bulk Operations**: Mark as featured, hide/show, delete multiple items
- **File Preview**: Thumbnail previews and file details
- **Search & Sort**: Find media quickly with search and sorting options

### ✅ **Media Organization**
- **Categories**: Gallery, Carousel, Hero, Events, Members, Training, Competitions
- **Featured Items**: Priority display for important media
- **Visibility Control**: Show/hide media from public galleries
- **Custom Sorting**: Manual sort order control
- **Tagging System**: Organize with custom tags

### ✅ **File Support**
- **Images**: JPG, PNG, GIF, WebP, SVG, BMP (up to 50MB)
- **Videos**: MP4, WebM, OGG, MOV, AVI, WMV (up to 50MB)
- **Auto-detection**: Automatic file type and metadata extraction
- **SEO Ready**: Alt text and description fields

### ✅ **Frontend Integration**
- **Carousel Display**: Automatic loading in hero carousel
- **Gallery Pages**: Dedicated photo and video galleries
- **API Endpoints**: REST API for frontend consumption
- **Fallback System**: File system scanning when database is empty

## 📋 Setup Instructions

### 1. **Activate PHP Extensions**
Make sure these extensions are enabled in your control panel:
- `ext-exif` - Image metadata extraction
- `ext-gd` - Image processing
- `ext-intl` - Internationalization
- `ext-zip` - File compression

### 2. **Install Dependencies**
```bash
composer install
```

### 3. **Run Database Migration**
```bash
php artisan migrate
```

### 4. **Seed Sample Data** (Optional)
```bash
php artisan db:seed --class=MediaSeeder
# OR full database seed including media
php artisan db:seed
```

### 5. **Create Storage Directories**
```bash
php artisan storage:link
mkdir -p storage/app/public/gallery/images
mkdir -p storage/app/public/gallery/videos
```

## 🎯 Usage

### **Admin Panel Access**
1. Login to your Filament admin panel
2. Navigate to **"Media Gallery"** in the sidebar
3. Click **"Upload Media"** to add new files

### **Frontend Display**
The carousel in your hero section automatically loads from the database:
- **Priority**: Database managed media → Storage files → Demo content
- **Mix**: Combines images and videos for variety
- **Categories**: Shows media from `carousel`, `gallery`, and `hero` categories

## 📁 File Structure

```
/app/
├── Models/Media.php                           # Media model with relationships
├── Filament/Resources/MediaResource.php       # Admin interface
├── Filament/Resources/MediaResource/Pages/    # Admin pages
└── Http/Controllers/Api/MediaApiController.php # API endpoints

/database/
├── migrations/2025_01_30_000001_create_media_table.php
├── factories/MediaFactory.php                # Test data factory
└── seeders/MediaSeeder.php                  # Sample data seeder

/routes/
└── api.php                                   # API route definitions
```

## 🔌 API Endpoints

### **Public Endpoints** (No authentication required)

```http
GET /api/media/carousel?limit=10    # Get carousel media
GET /api/media/photos               # Get gallery photos
GET /api/media/videos               # Get gallery videos  
GET /api/media/featured?limit=6     # Get featured media
```

### **Response Format**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "url": "/storage/gallery/images/photo.jpg",
      "title": "Training Session",
      "description": "Team training at our facility",
      "type": "image",
      "category": "training",
      "is_featured": true,
      "tags": ["training", "team", "gym"]
    }
  ],
  "meta": {
    "total": 5,
    "images": 3,
    "videos": 2
  }
}
```

## 🎨 Customization

### **Add New Categories**
Edit the `CATEGORIES` constant in `/app/Models/Media.php`:

```php
const CATEGORIES = [
    'gallery' => 'Gallery',
    'carousel' => 'Carousel', 
    'your_category' => 'Your Category Name',
    // ... add more
];
```

### **File Upload Limits**
Modify in `/app/Filament/Resources/MediaResource.php`:

```php
->maxSize(50000) // 50MB (in KB)
```

### **Carousel Item Limits**
Adjust in `/app/Livewire/Media/MediaCarousel.php`:

```php
public $maxItems = 10; // Change as needed
```

## 🔧 Model Methods

### **Static Methods**
```php
Media::getCarouselImages(10)    # Get images for carousel
Media::getCarouselVideos(5)     # Get videos for carousel  
Media::getGalleryImages()       # Get all gallery photos
Media::getGalleryVideos()       # Get all gallery videos
```

### **Scopes**
```php
Media::visible()                # Only visible items
Media::featured()               # Only featured items
Media::byType('image')          # Filter by type
Media::byCategory('gallery')    # Filter by category
Media::ordered()                # Sort by order + date
```

### **Instance Methods**
```php
$media->isImage()               # Check if image
$media->isVideo()               # Check if video
$media->getFormattedSizeAttribute() # Human readable size
$media->url                     # Public URL
```

## 🛠️ Troubleshooting

### **No Media Displayed**
1. Check if migration ran: `php artisan migrate:status`
2. Verify storage symlink: `ls -la public/storage`
3. Check file permissions on storage directories
4. Ensure media records exist: Check admin panel

### **Upload Errors**
1. Verify PHP extensions are enabled
2. Check file size limits in php.ini
3. Ensure storage directories are writable
4. Check Laravel logs: `storage/logs/laravel.log`

### **Carousel Shows Demo Content**
1. Upload media through admin panel
2. Set category to 'carousel' or 'gallery'
3. Mark as visible and featured if needed
4. Check database connection

## 🔒 Security

- **File Validation**: Strict MIME type checking
- **Size Limits**: Configurable upload size limits  
- **Storage Isolation**: Files stored outside web root
- **Access Control**: Admin-only upload/management
- **Clean URLs**: No direct file system access

## 📈 Performance

- **Database Indexes**: Optimized queries with proper indexing
- **Lazy Loading**: Efficient relationship loading
- **Caching Ready**: API responses can be cached
- **Image Optimization**: Automatic resize on upload (configurable)

---

## 🎉 You're Ready!

Your media management system is now set up! You can:

1. **Upload media** through the Filament admin panel
2. **Organize by categories** and mark items as featured
3. **View in carousel** on your hero page automatically
4. **Browse galleries** on dedicated photo/video pages
5. **Use API endpoints** for custom frontend implementations

The system will automatically fall back to file scanning if the database is empty, ensuring your existing media files continue to work while you migrate to the new system.
