<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * MediaSeeder
 * 
 * Seeds the media table with sample photos and videos
 * for development and demonstration purposes.
 */
class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample image media items
        $sampleImages = [
            [
                'title' => 'Club Training Session',
                'description' => 'Members during an intensive training session at our main facility.',
                'category' => 'training',
                'is_featured' => true,
                'sort_order' => 1,
                'tags' => ['training', 'members', 'gym'],
            ],
            [
                'title' => 'Competition Victory',
                'description' => 'Celebrating our recent competition victory with team members.',
                'category' => 'competitions',
                'is_featured' => true,
                'sort_order' => 2,
                'tags' => ['competition', 'victory', 'team'],
            ],
            [
                'title' => 'Club Facilities',
                'description' => 'Our modern training facilities with state-of-the-art equipment.',
                'category' => 'gallery',
                'is_featured' => false,
                'sort_order' => 3,
                'tags' => ['facilities', 'equipment', 'modern'],
            ],
            [
                'title' => 'New Members Welcome',
                'description' => 'Welcoming new members to our bodybuilding community.',
                'category' => 'members',
                'is_featured' => false,
                'sort_order' => 4,
                'tags' => ['members', 'welcome', 'community'],
            ],
            [
                'title' => 'Annual Event',
                'description' => 'Highlights from our annual club gathering and awards ceremony.',
                'category' => 'events',
                'is_featured' => true,
                'sort_order' => 5,
                'tags' => ['events', 'annual', 'awards'],
            ],
        ];

        // Create sample video media items
        $sampleVideos = [
            [
                'title' => 'Training Techniques',
                'description' => 'Professional training techniques demonstration by our coaches.',
                'category' => 'training',
                'is_featured' => true,
                'sort_order' => 6,
                'tags' => ['training', 'techniques', 'coaching'],
            ],
            [
                'title' => 'Competition Highlights',
                'description' => 'Best moments from our recent bodybuilding competition.',
                'category' => 'competitions',
                'is_featured' => false,
                'sort_order' => 7,
                'tags' => ['competition', 'highlights', 'bodybuilding'],
            ],
        ];

        // Create image entries
        foreach ($sampleImages as $index => $imageData) {
            $this->createMediaEntry($imageData, 'image', $index + 1);
        }

        // Create video entries  
        foreach ($sampleVideos as $index => $videoData) {
            $this->createMediaEntry($videoData, 'video', $index + 1);
        }

        $this->command->info('Media seeder completed. Created ' . count($sampleImages) . ' images and ' . count($sampleVideos) . ' videos.');
    }

    /**
     * Create a media entry with sample file
     */
    private function createMediaEntry(array $data, string $mediaType, int $index): void
    {
        // Generate a sample file path
        $extension = $mediaType === 'image' ? 'jpg' : 'mp4';
        $fileName = Str::slug($data['title']) . '.' . $extension;
        $filePath = "gallery/{$mediaType}s/{$fileName}";
        
        // Create the media record
        Media::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_size' => $mediaType === 'image' ? rand(500000, 3000000) : rand(5000000, 50000000), // Random realistic sizes
            'mime_type' => $mediaType === 'image' ? 'image/jpeg' : 'video/mp4',
            'media_type' => $mediaType,
            'category' => $data['category'],
            'is_featured' => $data['is_featured'],
            'is_visible' => true,
            'sort_order' => $data['sort_order'],
            'alt_text' => $data['title'],
            'tags' => $data['tags'],
            'metadata' => [
                'width' => $mediaType === 'image' ? rand(1200, 1920) : 1920,
                'height' => $mediaType === 'image' ? rand(800, 1080) : 1080,
                'duration' => $mediaType === 'video' ? rand(30, 300) : null, // seconds
                'format' => $extension,
                'created_by' => 'seeder',
            ],
        ]);
    }

    /**
     * Create sample directories if they don't exist
     */
    private function ensureDirectoriesExist(): void
    {
        $directories = [
            'gallery/images',
            'gallery/videos',
            'media/images', 
            'media/videos',
        ];

        foreach ($directories as $directory) {
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
        }
    }
}
