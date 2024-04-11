<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $performances = [

        ];

        foreach ($performances as $performance) {
            Listing::create([
                'name' => $performance['name'],
                'description' => $performance['description'],
                'starttime' => $performance['starttime'],
                'endtime' => $performance['endtime'],
                'image' => $performance['image'],
                'location' => $performance['location'],
                'available_seats' => $performance['available_seats'],
                'tickets_remaining' => $performance['tickets_remaining'],
                'price' => $performance['price'],
            ]);
        }
    }
}