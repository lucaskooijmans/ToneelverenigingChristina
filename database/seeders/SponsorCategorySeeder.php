<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsorcategories;

class SponsorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorCategories = [
            ['id' => 1, 'category_position' => 1, 'sponsorcategories' => 'Technologiebedrijven'],
            ['id' => 2, 'category_position' => 2, 'sponsorcategories' => 'Financiële Instellingen'],
            ['id' => 3, 'category_position' => 3, 'sponsorcategories' => 'Gezondheidszorg Organisaties'],
            ['id' => 4, 'category_position' => 4, 'sponsorcategories' => 'Educatieve Instellingen'],
            ['id' => 5, 'category_position' => 5, 'sponsorcategories' => 'Voedsel en Drank Bedrijven'],
            ['id' => 6, 'category_position' => 6, 'sponsorcategories' => 'Non-profit Organisaties'],
        ];

        foreach ($sponsorCategories as $category) {
            Sponsorcategories::create([
                'id' => $category['id'],
                'category_position' => $category['category_position'],
                'sponsorcategories' => $category['sponsorcategories'],
            ]);
        }
    }
}
