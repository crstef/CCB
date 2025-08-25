<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class GalleryPhotosSeeder extends Seeder
{
    /**
     * Seed the gallery with test photos for canine competitions
     */
    public function run(): void
    {
        // Photographs data for canine competitions
        $photos = [
            [
                'title' => 'Campionatul Național 2024 - Categoria Juniori',
                'description' => 'Competiție de agilitate pentru categoria juniori la Campionatul Național CCB România 2024',
                'category' => 'competitions',
                'tags' => ['campionat', 'agilitate', 'juniori', '2024'],
            ],
            [
                'title' => 'Groenendael în proba de obedience',
                'description' => 'Exemplar de Groenendael demonstrând excelența în proba de obedience la concursul internațional',
                'category' => 'competitions',
                'tags' => ['groenendael', 'obedience', 'concurs'],
            ],
            [
                'title' => 'Malinois - Demonstrație de lucru',
                'description' => 'Câine Malinois în timpul unei demonstrații de lucru și dresaj specializat',
                'category' => 'training',
                'tags' => ['malinois', 'dresaj', 'demonstratie'],
            ],
            [
                'title' => 'Tervueren în Ring Belgian',
                'description' => 'Competiție Ring Belgian cu un exemplar excepțional de Tervueren',
                'category' => 'competitions',
                'tags' => ['tervueren', 'ring-belgian', 'competitie'],
            ],
            [
                'title' => 'Laekenois - Proba de tracking',
                'description' => 'Câine Laekenois în timpul probei de tracking la concursul regional',
                'category' => 'competitions',
                'tags' => ['laekenois', 'tracking', 'regional'],
            ],
            [
                'title' => 'Ceremonia de premiere 2024',
                'description' => 'Momentul premierii câștigătorilor la Campionatul Național CCB România 2024',
                'category' => 'events',
                'tags' => ['premiere', 'campionat', 'castigatori'],
            ],
            [
                'title' => 'Antrenament în grup - Ciobanesc Belgian',
                'description' => 'Sesiune de antrenament în grup pentru câinii de rasă Ciobanesc Belgian',
                'category' => 'training',
                'tags' => ['antrenament', 'grup', 'ciobanesc-belgian'],
            ],
            [
                'title' => 'Prezentare morfologică - Groenendael',
                'description' => 'Prezentare morfologică a unui Groenendael campion la expoziția canină',
                'category' => 'competitions',
                'tags' => ['morfologie', 'groenendael', 'expozitie'],
            ],
            [
                'title' => 'Workshop de dresaj - Tehnici avansate',
                'description' => 'Workshop dedicat tehnicilor avansate de dresaj pentru rasele belgiene',
                'category' => 'training',
                'tags' => ['workshop', 'dresaj', 'tehnici-avansate'],
            ],
            [
                'title' => 'Competiție internațională IPO',
                'description' => 'Participarea echipei CCB România la competiția internațională IPO',
                'category' => 'competitions',
                'tags' => ['ipo', 'international', 'echipa'],
            ],
            [
                'title' => 'Demonstrație pentru publicul larg',
                'description' => 'Demonstrație publică de dresaj și abilități canine la evenimentul comunitar',
                'category' => 'events',
                'tags' => ['demonstratie', 'public', 'comunitate'],
            ],
            [
                'title' => 'Malinois în proba de protecție',
                'description' => 'Câine Malinois demonstrând tehnicile de protecție în cadrul competiției',
                'category' => 'competitions',
                'tags' => ['malinois', 'protectie', 'tehnici'],
            ],
            [
                'title' => 'Sesiune foto profesională - Tervueren',
                'description' => 'Sesiune foto profesională cu un exemplar campion de Tervueren',
                'category' => 'gallery',
                'tags' => ['foto', 'tervueren', 'campion'],
            ],
            [
                'title' => 'Examen de aptitudini - Cățeluși',
                'description' => 'Examen de aptitudini pentru cățeluși de rasă Ciobanesc Belgian',
                'category' => 'training',
                'tags' => ['aptitudini', 'catelusii', 'examen'],
            ],
            [
                'title' => 'Gala anuală CCB România 2024',
                'description' => 'Momentele cele mai frumoase de la Gala anuală a Clubului Ciobanesc Belgian România',
                'category' => 'events',
                'tags' => ['gala', 'anual', 'ccb-romania'],
            ],
        ];

        // Create the photos with placeholder images
        foreach ($photos as $index => $photoData) {
            // Generate a unique file name
            $fileName = 'ccb_' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '.jpg';
            $filePath = 'gallery/photos/' . $fileName;
            
            // Create the media record
            Media::create([
                'title' => $photoData['title'],
                'description' => $photoData['description'],
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_size' => rand(800000, 2500000), // Random file size between 800KB - 2.5MB
                'mime_type' => 'image/jpeg',
                'media_type' => 'image',
                'category' => $photoData['category'],
                'is_featured' => in_array($index, [0, 5, 9, 14]), // Make some photos featured
                'is_visible' => true,
                'sort_order' => $index,
                'alt_text' => $photoData['title'],
                'tags' => json_encode($photoData['tags']),
                'metadata' => json_encode([
                    'width' => 1920,
                    'height' => 1280,
                    'camera' => 'Canon EOS R5',
                    'photographer' => 'CCB România',
                    'event_date' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                ]),
                'created_at' => now()->subDays(rand(1, 90)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('Gallery photos seeded successfully!');
        $this->command->info('Created ' . count($photos) . ' test photos for the gallery.');
        $this->command->warn('Note: These are placeholder records. You\'ll need to upload actual image files through the admin panel.');
    }
}
