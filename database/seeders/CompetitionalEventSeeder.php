<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompetitionalEvent;
use Carbon\Carbon;

class CompetitionalEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'date_start' => Carbon::create(2025, 10, 17),
                'date_end' => null,
                'nume_competitie' => 'Expozitie Club',
                'locatie' => 'Baile 1 Mai, jud Bihor',
                'descriere' => null,
                'colaborare' => null,
                'order' => 1
            ],
            [
                'date_start' => Carbon::create(2025, 10, 17),
                'date_end' => null,
                'nume_competitie' => 'Examen BH&TSAC',
                'locatie' => 'Baile 1 Mai, jud Bihor',
                'descriere' => null,
                'colaborare' => null,
                'order' => 2
            ],
            [
                'date_start' => Carbon::create(2025, 10, 18),
                'date_end' => null,
                'nume_competitie' => 'Mondioring',
                'locatie' => 'Baile 1 Mai, jud. Bihor',
                'descriere' => 'Competitie de Club',
                'colaborare' => null,
                'order' => 3
            ],
            [
                'date_start' => Carbon::create(2025, 10, 19),
                'date_end' => null,
                'nume_competitie' => 'Mondioring',
                'locatie' => 'Baile 1 Mai, jud Bihor',
                'descriere' => 'Competitie de Club',
                'colaborare' => null,
                'order' => 4
            ],
            [
                'date_start' => Carbon::create(2025, 11, 1),
                'date_end' => Carbon::create(2025, 11, 2),
                'nume_competitie' => 'IGP',
                'locatie' => 'Domnesti, jud Ilfov',
                'descriere' => 'Etapa de calificare FMBB 2026',
                'colaborare' => 'Colaborare cu CNCG',
                'order' => 5
            ],
            [
                'date_start' => Carbon::create(2025, 11, 1),
                'date_end' => Carbon::create(2025, 11, 2),
                'nume_competitie' => 'Mondioring',
                'locatie' => 'Jucu, jud. Cluj',
                'descriere' => 'Etapa calificare FMBB 2026',
                'colaborare' => 'Colaborare cu ACMR',
                'order' => 6
            ],
            [
                'date_start' => Carbon::create(2026, 3, 28),
                'date_end' => Carbon::create(2026, 3, 29),
                'nume_competitie' => 'IGP',
                'locatie' => 'Turnu, Jud Arad',
                'descriere' => 'Etapa calificare FMBB 2026',
                'colaborare' => 'Colaborare cu CNCG',
                'order' => 7
            ],
            [
                'date_start' => Carbon::create(2026, 4, 4),
                'date_end' => null,
                'nume_competitie' => 'Agility',
                'locatie' => 'Bucuresti',
                'descriere' => 'Etapa calificare FMBB 2026',
                'colaborare' => null,
                'order' => 8
            ],
            [
                'date_start' => Carbon::create(2026, 6, 6),
                'date_end' => Carbon::create(2026, 6, 7),
                'nume_competitie' => 'Mondioring',
                'locatie' => 'Murighiol, jud Tulcea',
                'descriere' => 'Etapa calificare FMBB 2027',
                'colaborare' => 'Colaborare cu ACMR',
                'order' => 9
            ],
            [
                'date_start' => Carbon::create(2026, 9, 5),
                'date_end' => null,
                'nume_competitie' => 'Agility',
                'locatie' => 'Bucuresti',
                'descriere' => 'Etapa calificare FMBB 2027',
                'colaborare' => null,
                'order' => 10
            ]
        ];

        foreach ($events as $eventData) {
            CompetitionalEvent::create(array_merge($eventData, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}