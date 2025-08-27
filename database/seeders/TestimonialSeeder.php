<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Panoiu Gabriel',
                'position' => 'Președinte CCB',
                'description' => 'Cu peste 15 ani de experiență în creșterea și dresajul ciobănescului belgian, conduce cu pasiune și dedicare activitățile clubului.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Cosmin Pop Moldovan',
                'position' => 'Vicepreședinte CCB - responsabil mondioring',
                'description' => 'Specialist în disciplina mondioring, cu numeroase premii și experiență vastă în antrenamentul câinilor de lucru.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Attila Toth',
                'position' => 'Vicepreședinte CCB - responsabil IGP',
                'description' => 'Expert în disciplina IGP, cu focus pe dezvoltarea și promovarea standardelor înalte de antrenament.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dan Zloteanu',
                'position' => 'Vicepreședinte CCB - responsabil Agility',
                'description' => 'Pasionat de agility, organizează și coordonează competițiile și antrenamentele pentru această disciplină dinamică.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Flaviu Bajan',
                'position' => 'Vicepreședinte CCB - responsabil Organizare generală',
                'description' => 'Se ocupă de aspectele organizatorice și administrative ale clubului, asigurând buna funcționare a activităților.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
