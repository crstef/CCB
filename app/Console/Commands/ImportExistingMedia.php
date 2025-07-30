<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * ImportExistingMedia Command
 * 
 * Scans storage directories and imports existing media files
 * into the database for management through Filament.
 */
class ImportExistingMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:import
                           {--force : Force import even if files already exist in database}
                           {--dry-run : Show what would be imported without actually importing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import existing media files from storage into the database';

    /**
     * Storage directories to scan
     */
    protected $scanDirectories = [
        'gallery/photos',
        'gallery/videos',
        'gallery/images',
        'media/images',
        'media/videos',
        'uploads/gallery',
        'uploads'
    ];

    /**
     * Supported file extensions
     */
    protected $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
    protected $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv'];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');
        $dryRun = $this->option('dry-run');

        $this->info('🔍 Scanning storage directories for media files...');
        
        $foundFiles = $this->scanForMediaFiles();
        
        if (empty($foundFiles)) {
            $this->warn('No media files found in storage directories.');
            return 0;
        }

        $this->info("📁 Found " . count($foundFiles) . " media files");

        if ($dryRun) {
            $this->showDryRunResults($foundFiles);
            return 0;
        }

        $this->info('📤 Starting import process...');
        
        $imported = 0;
        $skipped = 0;
        $errors = 0;

        $progressBar = $this->output->createProgressBar(count($foundFiles));
        $progressBar->start();

        foreach ($foundFiles as $file) {
            try {
                if ($this->importFile($file, $force)) {
                    $imported++;
                } else {
                    $skipped++;
                }
            } catch (\Exception $e) {
                $errors++;
                $this->error("Error importing {$file['path']}: " . $e->getMessage());
            }
            
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        // Show results
        $this->info("✅ Import completed!");
        $this->table(['Result', 'Count'], [
            ['Imported', $imported],
            ['Skipped', $skipped],
            ['Errors', $errors],
            ['Total', count($foundFiles)],
        ]);

        return 0;
    }

    /**
     * Scan storage directories for media files
     */
    protected function scanForMediaFiles(): array
    {
        $files = [];
        
        foreach ($this->scanDirectories as $directory) {
            if (!Storage::disk('public')->exists($directory)) {
                continue;
            }

            $directoryFiles = Storage::disk('public')->allFiles($directory);
            
            foreach ($directoryFiles as $filePath) {
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                
                if (in_array($extension, array_merge($this->imageExtensions, $this->videoExtensions))) {
                    $files[] = [
                        'path' => $filePath,
                        'name' => pathinfo($filePath, PATHINFO_FILENAME),
                        'extension' => $extension,
                        'type' => in_array($extension, $this->imageExtensions) ? 'image' : 'video',
                        'size' => Storage::disk('public')->size($filePath),
                        'mime' => Storage::disk('public')->mimeType($filePath),
                    ];
                }
            }
        }

        return $files;
    }

    /**
     * Show dry run results
     */
    protected function showDryRunResults(array $files): void
    {
        $this->info('🧪 DRY RUN - The following files would be imported:');
        
        $tableData = [];
        foreach ($files as $file) {
            $tableData[] = [
                $file['path'],
                $file['type'],
                $this->formatBytes($file['size']),
                $this->generateTitle($file['name']),
            ];
        }

        $this->table(['File Path', 'Type', 'Size', 'Generated Title'], $tableData);
    }

    /**
     * Import a single file
     */
    protected function importFile(array $file, bool $force): bool
    {
        // Check if already exists
        $existing = Media::where('file_path', $file['path'])->first();
        
        if ($existing && !$force) {
            return false; // Skipped
        }

        if ($existing && $force) {
            $existing->delete(); // Remove existing record
        }

        // Determine category based on path
        $category = $this->determineCategoryFromPath($file['path']);
        
        // Create media record
        Media::create([
            'title' => $this->generateTitle($file['name']),
            'description' => $this->generateDescription($file['name'], $file['type']),
            'file_name' => basename($file['path']),
            'file_path' => $file['path'],
            'file_size' => $file['size'],
            'mime_type' => $file['mime'],
            'media_type' => $file['type'],
            'category' => $category,
            'is_featured' => false,
            'is_visible' => true,
            'sort_order' => 0,
            'alt_text' => $this->generateTitle($file['name']),
            'tags' => $this->generateTags($file['name']),
            'metadata' => [
                'imported_from' => $file['path'],
                'original_size' => $file['size'],
                'import_date' => now()->toISOString(),
            ],
        ]);

        return true; // Imported
    }

    /**
     * Generate a human-readable title from filename
     */
    protected function generateTitle(string $filename): string
    {
        return Str::title(str_replace(['_', '-'], ' ', $filename));
    }

    /**
     * Generate a description
     */
    protected function generateDescription(string $filename, string $type): string
    {
        $base = $this->generateTitle($filename);
        return $type === 'image' ? "Image: {$base}" : "Video: {$base}";
    }

    /**
     * Determine category from file path
     */
    protected function determineCategoryFromPath(string $path): string
    {
        if (Str::contains($path, ['carousel', 'hero'])) {
            return 'carousel';
        }
        
        if (Str::contains($path, ['event', 'competition'])) {
            return 'events';
        }
        
        if (Str::contains($path, ['member', 'team'])) {
            return 'members';
        }
        
        if (Str::contains($path, ['training', 'workout'])) {
            return 'training';
        }

        return 'gallery';
    }

    /**
     * Generate tags from filename
     */
    protected function generateTags(string $filename): array
    {
        $commonTags = ['bodybuilding', 'gym', 'fitness', 'training', 'team'];
        $tags = [];
        
        foreach ($commonTags as $tag) {
            if (Str::contains(strtolower($filename), $tag)) {
                $tags[] = $tag;
            }
        }

        return array_unique($tags);
    }

    /**
     * Format bytes to human readable format
     */
    protected function formatBytes(int $size): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, 2) . ' ' . $units[$i];
    }
}
