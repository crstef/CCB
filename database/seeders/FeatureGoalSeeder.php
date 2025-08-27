<?php

namespace Database\Seeders;

use App\Models\FeatureGoal;
use Illuminate\Database\Seeder;

class FeatureGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $featureGoals = [
            [
                'title' => 'Dezvoltarea comunității',
                'description' => 'Extindem comunitatea CCB prin atragerea de noi membri pasionați de rasa ciobănesc belgian.',
                'icon' => 'users',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Îmbunătățirea standardelor',
                'description' => 'Lucrăm constant pentru îmbunătățirea standardelor de creștere și dresaj ale raselor belgiene.',
                'icon' => 'star',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Competiții naționale',
                'description' => 'Organizăm și susținem competiții naționale pentru promovarea disciplinelor sportive canine.',
                'icon' => 'trophy',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Educație și formare',
                'description' => 'Oferim programe de educație pentru proprietarii de câini și viitorii crescători profesioniști.',
                'icon' => 'academic-cap',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Platformă digitală modernă',
                'description' => 'Dezvoltăm o platformă digitală avansată pentru gestionarea eficientă a activităților clubului.',
                'icon' => 'cpu-chip',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Colaborări internaționale',
                'description' => 'Stabilim parteneriate cu cluburi internaționale pentru schimburi de experiență și bune practici.',
                'icon' => 'globe-alt',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($featureGoals as $featureGoal) {
            FeatureGoal::create($featureGoal);
        }
    }
}
