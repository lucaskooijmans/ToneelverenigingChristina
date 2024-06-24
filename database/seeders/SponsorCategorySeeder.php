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
            ['id' => 1, 'category_position' => 1, 'sponsorcategories' => 'Sponsoren verloting'],
            ['id' => 2, 'category_position' => 2, 'sponsorcategories' => 'Bedankjes & catering spelers'],
            ['id' => 3, 'category_position' => 3, 'sponsorcategories' => 'Spullen omtrent het toneel(decor)'],
            ['id' => 4, 'category_position' => 4, 'sponsorcategories' => 'Overig'],
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
