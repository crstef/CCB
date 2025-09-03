<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportOldDocuments extends Command
{
    protected $signature = 'documents:import {--dry-run : Run without making changes}';
    protected $description = 'Import documents from old Wave 2.0 site to new Wave 3.0 structure';

    public function handle()
    {
        $this->info('Starting import of documents from old site...');

        // Read the SQL file
        $sqlFile = base_path('documents_export.sql');
        if (!file_exists($sqlFile)) {
            $this->error('documents_export.sql not found in project root!');
            return 1;
        }

        // Parse the SQL file to extract INSERT statements
        $oldDocuments = $this->parseOldDocuments($sqlFile);
        
        if (empty($oldDocuments)) {
            $this->error('No documents found in SQL file!');
            return 1;
        }

        $this->info('Found ' . count($oldDocuments) . ' documents to import.');

        // Create categories mapping
        $categoryMapping = $this->createCategoryMapping($oldDocuments);

        $imported = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($oldDocuments as $oldDoc) {
            try {
                if ($this->importDocument($oldDoc, $categoryMapping)) {
                    $imported++;
                    $this->line("✓ Imported: {$oldDoc['title']}");
                } else {
                    $skipped++;
                    $this->line("- Skipped: {$oldDoc['title']} (already exists or no files)");
                }
            } catch (\Exception $e) {
                $errors++;
                $this->error("✗ Error importing {$oldDoc['title']}: " . $e->getMessage());
            }
        }

        $this->info("\nImport completed!");
        $this->table(['Status', 'Count'], [
            ['Imported', $imported],
            ['Skipped', $skipped],
            ['Errors', $errors],
            ['Total', count($oldDocuments)]
        ]);

        return 0;
    }

    private function parseOldDocuments($sqlFile)
    {
        $content = file_get_contents($sqlFile);
        
        // Extract INSERT statements for documents table
        preg_match_all(
            '/INSERT INTO `documents` \([^)]+\) VALUES\s*(.+?);/s',
            $content,
            $matches
        );

        if (empty($matches[1])) {
            return [];
        }

        $documents = [];
        $valuesString = $matches[1][0];

        // Parse each row - this is a simplified parser for the specific format
        preg_match_all('/\(([^)]+(?:\([^)]*\)[^)]*)*)\)/s', $valuesString, $rowMatches);

        foreach ($rowMatches[1] as $rowData) {
            $doc = $this->parseRowData($rowData);
            if ($doc) {
                $documents[] = $doc;
            }
        }

        return $documents;
    }

    private function parseRowData($rowData)
    {
        // This is a simplified parser - may need adjustments for complex data
        $parts = [];
        $current = '';
        $inQuotes = false;
        $quoteChar = '';
        $level = 0;

        for ($i = 0; $i < strlen($rowData); $i++) {
            $char = $rowData[$i];

            if (!$inQuotes && ($char === "'" || $char === '"')) {
                $inQuotes = true;
                $quoteChar = $char;
                $current .= $char;
            } elseif ($inQuotes && $char === $quoteChar && $rowData[$i-1] !== '\\') {
                $inQuotes = false;
                $current .= $char;
            } elseif (!$inQuotes && $char === '[') {
                $level++;
                $current .= $char;
            } elseif (!$inQuotes && $char === ']') {
                $level--;
                $current .= $char;
            } elseif (!$inQuotes && $char === ',' && $level === 0) {
                $parts[] = trim($current);
                $current = '';
            } else {
                $current .= $char;
            }
        }
        
        if (!empty($current)) {
            $parts[] = trim($current);
        }

        if (count($parts) < 6) {
            return null;
        }

        // Clean up the values
        $cleanParts = array_map(function($part) {
            $part = trim($part);
            if ($part === 'NULL') {
                return null;
            }
            if (preg_match('/^[\'"](.*)[\'"]/s', $part, $matches)) {
                return str_replace(['\\\'', '\\"'], ["'", '"'], $matches[1]);
            }
            return $part;
        }, $parts);

        return [
            'id' => (int)$cleanParts[0],
            'title' => $cleanParts[1],
            'type' => $cleanParts[2],
            'file' => $cleanParts[3],
            'file1' => $cleanParts[4],
            'created_at' => $cleanParts[5],
            'updated_at' => $cleanParts[6],
        ];
    }

    private function createCategoryMapping($oldDocuments)
    {
        $types = array_unique(array_column($oldDocuments, 'type'));
        $mapping = [];

        $this->info('Creating categories...');

        foreach ($types as $type) {
            if (empty($type) || $type === 'NULL') continue;

            // Check if category already exists
            $category = DocumentCategory::where('name', $type)->first();
            
            if (!$category) {
                if (!$this->option('dry-run')) {
                    $category = DocumentCategory::create([
                        'name' => $type,
                        'slug' => Str::slug($type),
                        'description' => "Importat din site-ul vechi - {$type}",
                        'color' => $this->getColorForCategory($type),
                        'sort_order' => 0,
                        'is_active' => true,
                    ]);
                }
                $this->line("+ Created category: {$type}");
            }

            $mapping[$type] = $category ? $category->id : null;
        }

        return $mapping;
    }

    private function getColorForCategory($type)
    {
        $colors = [
            'decizie' => '#ef4444',      // red
            'hotarare' => '#22c55e',     // green  
            'regulament' => '#3b82f6',   // blue
            'statut' => '#8b5cf6',       // purple
            'convocator' => '#f59e0b',   // amber
            'procedura' => '#06b6d4',    // cyan
            'recomandari' => '#84cc16',  // lime
        ];

        $lowerType = strtolower($type);
        foreach ($colors as $key => $color) {
            if (strpos($lowerType, $key) !== false) {
                return $color;
            }
        }

        return '#6b7280'; // gray default
    }

    private function importDocument($oldDoc, $categoryMapping)
    {
        // Skip if no title or invalid data
        if (empty($oldDoc['title']) || $oldDoc['title'] === 'title') {
            return false;
        }

        // Check if document already exists
        $exists = Document::where('title', $oldDoc['title'])->exists();
        if ($exists) {
            return false;
        }

        // Parse files
        $files = $this->parseFiles($oldDoc['file'], $oldDoc['file1']);
        if (empty($files)) {
            return false; // Skip documents without files
        }

        if ($this->option('dry-run')) {
            $this->line("Would import: {$oldDoc['title']} with " . count($files) . " files");
            return true;
        }

        // Get category ID
        $categoryId = $categoryMapping[$oldDoc['type']] ?? null;
        if (!$categoryId) {
            // Create default category
            $defaultCategory = DocumentCategory::firstOrCreate([
                'name' => 'Diverse',
                'slug' => 'diverse'
            ], [
                'description' => 'Documente fără categorie specifică',
                'color' => '#6b7280',
                'sort_order' => 999,
                'is_active' => true,
            ]);
            $categoryId = $defaultCategory->id;
        }

        // Create document
        Document::create([
            'title' => $oldDoc['title'],
            'description' => null, // Old site doesn't have description
            'document_category_id' => $categoryId,
            'max_files' => count($files),
            'files' => $files,
            'is_active' => true,
            'created_at' => $oldDoc['created_at'],
            'updated_at' => $oldDoc['updated_at'],
        ]);

        return true;
    }

    private function parseFiles($file, $file1)
    {
        $files = [];

        // Parse first file
        if (!empty($file) && $file !== 'NULL' && $file !== '[]') {
            $parsed = $this->parseFileJson($file);
            if ($parsed) {
                $files = array_merge($files, $parsed);
            }
        }

        // Parse second file
        if (!empty($file1) && $file1 !== 'NULL' && $file1 !== '[]') {
            $parsed = $this->parseFileJson($file1);
            if ($parsed) {
                $files = array_merge($files, $parsed);
            }
        }

        return $files;
    }

    private function parseFileJson($fileJson)
    {
        try {
            $decoded = json_decode($fileJson, true);
            if (!is_array($decoded)) {
                return [];
            }

            $files = [];
            foreach ($decoded as $fileData) {
                if (isset($fileData['download_link']) && isset($fileData['original_name'])) {
                    $path = str_replace('\\', '/', $fileData['download_link']);
                    
                    $files[] = [
                        'path' => 'public/' . $path, // Add public/ prefix for new storage structure
                        'name' => $fileData['original_name'],
                        'original_name' => $fileData['original_name'],
                        'size' => null, // Will be calculated if file exists
                        'type' => pathinfo($fileData['original_name'], PATHINFO_EXTENSION),
                        'uploaded_at' => now()->toISOString(),
                    ];
                }
            }

            return $files;
        } catch (\Exception $e) {
            return [];
        }
    }
}
