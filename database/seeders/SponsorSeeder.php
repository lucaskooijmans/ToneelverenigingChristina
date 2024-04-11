<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'id' => 1,
                'name' => 'World of Chocolate',
                'url' => 'https://www.worldofchocolate.nl/',
                'position' => 1,
                'logo' => 'images/world_of_chocolate.jpg',
                'isActive' => 1,
                'category_id' => 2, // Bedankjes & catering spelers
            ],
            [
                'id' => 2,
                'name' => 'KVV de Poort',
                'url' => 'https://kvvdepoort.nl/',
                'position' => 2,
                'logo' => 'images/kvv_de_poort.jpg',
                'isActive' => 1,
                'category_id' => 1, // Sponsoren verloting
            ],
            [
                'id' => 3,
                'name' => 'Vers natuurlijk van Dieuwertje',
                'url' => 'https://www.facebook.com/VersNatuurlijkVanDieuwertje/',
                'position' => 3,
                'logo' => 'images/vers_natuurlijk.jpg',
                'isActive' => 1,
                'category_id' => 2, // Bedankjes & catering spelers
            ],
            [
                'id' => 4,
                'name' => 'Tuincentrum de graaf',
                'url' => 'https://www.tuincentrumdegraaf.nl/',
                'position' => 4,
                'logo' => 'images/de_graaf_bloemen.jpg',
                'isActive' => 1,
                'category_id' => 3, // Spullen omtrent het toneel(decor)
            ],
            [
                'id' => 5,
                'name' => 'Rozenhoek',
                'url' => 'https://www.facebook.com/rozenhoekravenswaaij',
                'position' => 5,
                'logo' => 'images/rozenhoek.jpg',
                'isActive' => 1,
                'category_id' => 4, // Overig
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create([
                'id' => $sponsor['id'],
                'name' => $sponsor['name'],
                'url' => $sponsor['url'],
                'position' => $sponsor['position'],
                'logo' => $sponsor['logo'],
                'isActive' => $sponsor['isActive'],
                'category_id' => $sponsor['category_id'],
            ]);
        }
    }
}
