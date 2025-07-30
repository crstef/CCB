<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * TestMediaScan Command
 * 
 * Tests the media scanning functionality to debug
 * what files are being detected in storage.
 */
class TestMediaScan extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'media:test-scan';

    /**
     * The console command description.
     */
    protected $description = 'Test media file scanning to debug carousel issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Testing media file scanning...');

        $mediaPaths = [
            'gallery/photos',
            'gallery/videos',
            'gallery',
            'uploads'
        ];

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp', 'tiff'];
        $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv', 'mkv'];

        $allFiles = [];

        foreach ($mediaPaths as $path) {
            $this->line("📁 Scanning: {$path}");
            
            if (Storage::disk('public')->exists($path)) {
                $files = Storage::disk('public')->files($path);
                $this->info("  Found " . count($files) . " files:");
                
                foreach ($files as $file) {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $isImage = in_array($extension, $imageExtensions);
                    $isVideo = in_array($extension, $videoExtensions);
                    $isMedia = $isImage || $isVideo;
                    
                    $type = $isImage ? 'IMAGE' : ($isVideo ? 'VIDEO' : 'OTHER');
                    $status = $isMedia ? '✅' : '❌';
                    
                    $this->line("    {$status} {$file} [{$type}] (.{$extension})");
                    
                    if ($isMedia) {
                        $url = Storage::disk('public')->url($file);
                        $this->line("       URL: {$url}");
                        $allFiles[] = $file;
                    }
                }
            } else {
                $this->warn("  Directory does not exist");
            }
            
            $this->line('');
        }

        $this->info("📊 Summary:");
        $this->info("Total media files found: " . count($allFiles));
        
        if (!empty($allFiles)) {
            $this->info("Media files:");
            foreach ($allFiles as $file) {
                $this->line("  • {$file}");
            }
        }

        // Test storage URL generation
        $this->line('');
        $this->info('🔗 Testing storage URL generation:');
        $storageUrl = Storage::disk('public')->url('/');
        $this->line("Storage base URL: {$storageUrl}");
        
        // Test if storage symlink works
        $symlinkPath = public_path('storage');
        $symlinkExists = is_link($symlinkPath);
        $symlinkTarget = $symlinkExists ? readlink($symlinkPath) : 'N/A';
        
        $this->line("Symlink exists: " . ($symlinkExists ? '✅ Yes' : '❌ No'));
        $this->line("Symlink target: {$symlinkTarget}");

        return 0;
    }
}
