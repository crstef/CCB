<?php

namespace Database\Seeders;

use App\Models\Document;
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
        $categories = Document::getCategories();
        
        foreach ($categories as $category => $label) {
            // Create 2-3 documents per category
            Document::factory()
                ->count(rand(2, 3))
                ->category($category)
                ->active()
                ->create();
        }

        // Create some specific examples
        Document::create([
            'title' => 'Regulament Intern de Organizare și Funcționare',
            'description' => 'Documentul care reglementează organizarea și funcționarea internă a organizației.',
            'category' => 'Regulamente',
            'max_files' => 2,
            'is_active' => true,
            'files' => null,
        ]);

        Document::create([
            'title' => 'Procedura de Achiziții Publice',
            'description' => 'Ghidul complet pentru derularea achizițiilor publice conform legislației în vigoare.',
            'category' => 'Proceduri',
            'max_files' => 3,
            'is_active' => true,
            'files' => null,
        ]);

        Document::create([
            'title' => 'Raport Anual de Activitate 2024',
            'description' => 'Raportul detaliat al activităților desfășurate în anul 2024.',
            'category' => 'Rapoarte',
            'max_files' => 1,
            'is_active' => true,
            'files' => null,
        ]);

        Document::create([
            'title' => 'Prezentare Strategia 2025-2030',
            'description' => 'Prezentarea strategică pentru perioada 2025-2030 cu obiectivele principale.',
            'category' => 'Prezentări',
            'max_files' => 2,
            'is_active' => true,
            'files' => null,
        ]);

        Document::create([
            'title' => 'Contract de Servicii IT',
            'description' => 'Contractul standard pentru furnizarea serviciilor IT.',
            'category' => 'Contracte',
            'max_files' => 1,
            'is_active' => true,
            'files' => null,
        ]);

        // Create some inactive documents
        Document::factory()
            ->count(3)
            ->inactive()
            ->create();

        $this->command->info('Documents seeded successfully!');
    }
}
