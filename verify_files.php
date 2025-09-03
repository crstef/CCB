<?php
/**
 * Verify imported document files exist and are accessible
 */
require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\Document;

echo "=== Document Files Verification ===\n\n";

$documents = Document::whereNotNull('files')->get();
$totalFiles = 0;
$existingFiles = 0;
$missingFiles = 0;

foreach ($documents as $doc) {
    echo "Document: {$doc->title}\n";
    
    if (is_array($doc->files)) {
        foreach ($doc->files as $file) {
            $totalFiles++;
            $path = $file['path'] ?? '';
            $name = $file['name'] ?? $file['original_name'] ?? 'Unknown';
            
            // Check different possible paths
            $possiblePaths = [
                storage_path('app/' . $path),
                storage_path('app/public/' . $path),
                public_path('storage/' . str_replace('public/', '', $path)),
                storage_path('app/' . str_replace('public/', '', $path))
            ];
            
            $found = false;
            foreach ($possiblePaths as $checkPath) {
                if (file_exists($checkPath)) {
                    $found = true;
                    $existingFiles++;
                    echo "  ✓ {$name} - Found at: {$checkPath}\n";
                    break;
                }
            }
            
            if (!$found) {
                $missingFiles++;
                echo "  ✗ {$name} - Missing: {$path}\n";
                echo "    Checked paths:\n";
                foreach ($possiblePaths as $checkPath) {
                    echo "      - {$checkPath}\n";
                }
            }
        }
    }
    echo "\n";
}

echo "=== Summary ===\n";
echo "Total files: {$totalFiles}\n";
echo "Existing files: {$existingFiles}\n";
echo "Missing files: {$missingFiles}\n";
echo "Success rate: " . round(($existingFiles / $totalFiles) * 100, 2) . "%\n";

if ($missingFiles > 0) {
    echo "\n=== Missing Files Paths ===\n";
    echo "You need to copy files from old server to:\n";
    echo "- storage/app/public/documents/\n";
    echo "Make sure to preserve the folder structure (May2023/, etc.)\n";
}
