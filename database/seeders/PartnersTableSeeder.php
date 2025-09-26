<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Federația Chinologică Română (FCI)',
                'description' => 'Organizația națională pentru standardele raselor de câini',
                'website_url' => 'https://www.fci.be/en/',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Asociația Chinologică Română',
                'description' => 'Organizația care promovează standardele internaționale',
                'website_url' => 'https://www.acr-romania.ro/',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Kennel Club România',
                'description' => 'Club național pentru înregistrarea și promovarea raselor',
                'website_url' => 'https://www.kennelclub.ro/',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Federația Mondială de Mondioring',
                'description' => 'Organizația internațională pentru sportul Mondioring',
                'website_url' => 'https://www.fmbb.org/',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partnerData) {
            Partner::create($partnerData);
        }
    }
}