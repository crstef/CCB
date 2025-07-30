<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample documents for each category
        $categories = DocumentCategory::active()->get();
        
        foreach ($categories as $category) {
            // Create 2-3 documents per category
            Document::factory()
                ->count(rand(2, 3))
                ->create([
                    'document_category_id' => $category->id,
                ]);
        }

        // Create some specific examples if categories exist
        $generalCategory = DocumentCategory::where('name', 'Regulamente')->first();
        $proceduresCategory = DocumentCategory::where('name', 'Proceduri')->first();
        $reportsCategory = DocumentCategory::where('name', 'Rapoarte')->first();
        $presentationsCategory = DocumentCategory::where('name', 'Prezentări')->first();
        $contractsCategory = DocumentCategory::where('name', 'Contracte')->first();

        if ($generalCategory) {
            Document::create([
                'title' => 'Regulament Intern de Organizare și Funcționare',
                'description' => 'Documentul care reglementează organizarea și funcționarea internă a organizației.',
                'document_category_id' => $generalCategory->id,
                'max_files' => 2,
                'is_active' => true,
                'files' => null,
            ]);
        }

        if ($proceduresCategory) {
            Document::create([
                'title' => 'Procedura de Achiziții Publice',
                'description' => 'Ghidul complet pentru derularea achizițiilor publice conform legislației în vigoare.',
                'document_category_id' => $proceduresCategory->id,
                'max_files' => 3,
                'is_active' => true,
                'files' => null,
            ]);
        }

        if ($reportsCategory) {
            Document::create([
                'title' => 'Raport Anual de Activitate 2024',
                'description' => 'Raportul detaliat al activităților desfășurate în anul 2024.',
                'document_category_id' => $reportsCategory->id,
                'max_files' => 1,
                'is_active' => true,
                'files' => null,
            ]);
        }

        if ($presentationsCategory) {
            Document::create([
                'title' => 'Prezentare Strategia 2025-2030',
                'description' => 'Prezentarea strategică pentru perioada 2025-2030 cu obiectivele principale.',
                'document_category_id' => $presentationsCategory->id,
                'max_files' => 2,
                'is_active' => true,
                'files' => null,
            ]);
        }

        if ($contractsCategory) {
            Document::create([
                'title' => 'Contract de Servicii IT',
                'description' => 'Contractul standard pentru furnizarea serviciilor IT.',
                'document_category_id' => $contractsCategory->id,
                'max_files' => 1,
                'is_active' => true,
                'files' => null,
            ]);
        }

        // Create some inactive documents
        if ($categories->count() > 0) {
            Document::factory()
                ->count(3)
                ->inactive()
                ->create([
                    'document_category_id' => $categories->random()->id,
                ]);
        }

        $this->command->info('Documents seeded successfully!');
    }
}
