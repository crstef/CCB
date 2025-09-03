<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DocumentCategory;
use App\Models\Document;
use Illuminate\Support\Str;

class MergeDocumentCategories extends Command
{
    protected $signature = 'documents:merge-categories {--dry-run : Show what would be merged without making changes}';
    protected $description = 'Merge duplicate document categories';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        $this->info('Analyzing document categories for duplicates...');
        $this->line('');

        // Define category merges - target => [sources to merge]
        $merges = [
            'Decizii CD' => ['decizie', 'decizii', 'Decizii CD'],
            'Convocator AG' => ['convocator AG', 'Convocare AG'],
            'Convocator CD' => ['convocator CD', 'Teleconferinta Consiliu Director CCBO'],
            'Regulamente' => ['regulament', 'Regulamente'],
            'Hotarari AG' => ['hotarare', 'Hotarâri AG'],
            'Statut' => ['statut'],
            'Recomandari' => ['recomandari'],
            'Proceduri' => ['Procedura', 'Proceduri'],
            'Taxe' => ['Taxe'],
        ];

        $totalMerged = 0;
        $totalDocuments = 0;

        foreach ($merges as $targetName => $sourceNames) {
            $this->info("Processing: {$targetName}");
            
            // Find or create target category
            $targetCategory = DocumentCategory::where('name', $targetName)->first();
            if (!$targetCategory) {
                if (!$isDryRun) {
                    $targetCategory = DocumentCategory::create([
                        'name' => $targetName,
                        'slug' => Str::slug($targetName),
                        'color' => $this->generateCategoryColor($targetName),
                        'description' => "Categoria unificată pentru {$targetName}"
                    ]);
                }
                $this->line("  → Would create target category: {$targetName}");
            } else {
                $this->line("  → Using existing category: {$targetName} (ID: {$targetCategory->id})");
            }

            // Find source categories to merge
            $sourceCategories = DocumentCategory::whereIn('name', $sourceNames)->get();
            
            foreach ($sourceCategories as $sourceCategory) {
                if ($targetCategory && $sourceCategory->id === $targetCategory->id) {
                    continue; // Skip if it's the same category
                }

                $documentsCount = $sourceCategory->documents()->count();
                $this->line("  → Merging: {$sourceCategory->name} ({$documentsCount} documents)");

                if (!$isDryRun && $targetCategory) {
                    // Move documents to target category
                    $sourceCategory->documents()->update(['document_category_id' => $targetCategory->id]);
                    
                    // Delete source category
                    $sourceCategory->delete();
                }

                $totalMerged++;
                $totalDocuments += $documentsCount;
            }
        }

        // Handle remaining categories that might need cleanup
        $this->line('');
        $this->info('Checking for other potential duplicates...');
        
        $remainingCategories = DocumentCategory::all();
        $potentialDuplicates = [];

        foreach ($remainingCategories as $category) {
            $similar = $remainingCategories->filter(function ($other) use ($category) {
                return $other->id !== $category->id && 
                       (Str::lower($other->name) === Str::lower($category->name) ||
                        similar_text(Str::lower($other->name), Str::lower($category->name), $percent) && $percent > 80);
            });

            if ($similar->count() > 0) {
                $potentialDuplicates[] = [
                    'main' => $category->name,
                    'similar' => $similar->pluck('name')->toArray()
                ];
            }
        }

        if (!empty($potentialDuplicates)) {
            $this->line('');
            $this->warn('Potential duplicates found:');
            foreach ($potentialDuplicates as $duplicate) {
                $this->line("  • {$duplicate['main']} ~ " . implode(', ', $duplicate['similar']));
            }
        }

        $this->line('');
        $this->line('=== Summary ===');
        $this->line("Categories to merge: {$totalMerged}");
        $this->line("Documents affected: {$totalDocuments}");
        
        if ($isDryRun) {
            $this->warn('This was a dry run. No changes were made.');
            $this->info('Run without --dry-run to apply changes.');
        } else {
            $this->info('Categories merged successfully!');
        }

        // Show final category list
        $this->line('');
        $this->info('Final categories:');
        $finalCategories = DocumentCategory::withCount('documents')->orderBy('name')->get();
        
        $headers = ['Name', 'Slug', 'Documents', 'Color'];
        $rows = [];

        foreach ($finalCategories as $category) {
            $rows[] = [
                $category->name,
                $category->slug,
                $category->documents_count,
                $category->color ?? 'default'
            ];
        }

        $this->table($headers, $rows);

        return 0;
    }

    private function generateCategoryColor($name)
    {
        $colors = [
            'primary', 'secondary', 'success', 'danger', 'warning', 
            'info', 'gray', 'red', 'orange', 'amber', 'yellow', 
            'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 
            'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'
        ];

        // Simple hash-based color selection
        $hash = crc32($name);
        return $colors[abs($hash) % count($colors)];
    }
}
