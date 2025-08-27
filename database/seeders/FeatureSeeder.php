<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'Management utilizatori',
                'description' => 'Gestionează cu ușurință utilizatorii cu panoul intuitiv CCB.',
                'icon' => 'users-three',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Autentificare securizată',
                'description' => 'Implementează login, înregistrare și autentificare cu doi factori în siguranță.',
                'icon' => 'shield-check',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Integrări terțe',
                'description' => 'Integrează cu ușurință servicii terțe populare pentru funcționalități extinse.',
                'icon' => 'puzzle-piece',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Analitice și rapoarte',
                'description' => 'Obține informații detaliate despre activitatea utilizatorilor cu sistemul integrat de analitice.',
                'icon' => 'chart-bar',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Personalizare interfață',
                'description' => 'Personalizează aspectul aplicației cu opțiuni avansate de tematizare CCB.',
                'icon' => 'paint-bucket',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Configurare simplă',
                'description' => 'Pornește rapid cu procesul simplu și intuitiv de configurare a platformei CCB.',
                'icon' => 'gear-fine',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Suport dedicat',
                'description' => 'Beneficiază de suportul comunității CCB pentru asistență și colaborare.',
                'icon' => 'lifebuoy',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Management media',
                'description' => 'Gestionează eficient fișierele multimedia cu managerul integrat CCB.',
                'icon' => 'images-square',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
