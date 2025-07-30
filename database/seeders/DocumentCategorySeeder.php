<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'General',
                'description' => 'Documente generale care nu se încadrează în alte categorii specifice',
                'color' => '#3B82F6',
                'sort_order' => 0,
            ],
            [
                'name' => 'Contracte',
                'description' => 'Contracte de colaborare, servicii și alte documente contractuale',
                'color' => '#059669',
                'sort_order' => 1,
            ],
            [
                'name' => 'Facturi',
                'description' => 'Facturi, note de plată și documente financiare',
                'color' => '#DC2626',
                'sort_order' => 2,
            ],
            [
                'name' => 'Rapoarte',
                'description' => 'Rapoarte de activitate, rapoarte anuale și alte tipuri de rapoarte',
                'color' => '#7C3AED',
                'sort_order' => 3,
            ],
            [
                'name' => 'Prezentări',
                'description' => 'Prezentări PowerPoint, materiale de prezentare',
                'color' => '#EA580C',
                'sort_order' => 4,
            ],
            [
                'name' => 'Regulamente',
                'description' => 'Regulamente interne, proceduri organizaționale',
                'color' => '#0891B2',
                'sort_order' => 5,
            ],
            [
                'name' => 'Proceduri',
                'description' => 'Proceduri de lucru, ghiduri și instrucțiuni',
                'color' => '#65A30D',
                'sort_order' => 6,
            ],
            [
                'name' => 'Alte Documente',
                'description' => 'Alte tipuri de documente care nu se încadrează în categoriile de mai sus',
                'color' => '#6B7280',
                'sort_order' => 7,
            ],
        ];

        foreach ($categories as $category) {
            DocumentCategory::create($category);
        }

        $this->command->info('Document categories seeded successfully!');
    }
}
