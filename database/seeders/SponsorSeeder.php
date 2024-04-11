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
                'name' => 'Rabobank',
                'url' => 'www.rabobank.nl',
                'position' => 1,
                'logo' => 'rabobank.jpg',
                'isActive' => 1,
                'category_id' => 2, // Financiële Instellingen
            ],
            [
                'id' => 2,
                'name' => 'Philips',
                'url' => 'www.philips.nl',
                'position' => 2,
                'logo' => 'philips.jpg',
                'isActive' => 1,
                'category_id' => 1, // Technologiebedrijven
            ],
            [
                'id' => 3,
                'name' => 'Unilever',
                'url' => 'www.unilever.nl',
                'position' => 3,
                'logo' => 'unilever.jpg',
                'isActive' => 1,
                'category_id' => 5, // Voedsel en Drank Bedrijven
            ],
            [
                'id' => 4,
                'name' => 'Erasmus MC',
                'url' => 'www.erasmusmc.nl',
                'position' => 4,
                'logo' => 'erasmusmc.jpg',
                'isActive' => 1,
                'category_id' => 3, // Gezondheidszorg Organisaties
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
