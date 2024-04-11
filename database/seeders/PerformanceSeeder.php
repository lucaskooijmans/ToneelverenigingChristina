<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Performance;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $performances = [
            [
                'name' => 'Het Mysterie van de Verloren Stem',
                'description' => 'Een spannend toneelstuk over een zangeres die haar stem verliest.',
                'starttime' => '2024-05-01 19:00:00',
                'endtime' => '2024-05-01 21:00:00',
                'image' => 'het_mysterie_van_de_verloren_stem.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'price' => 15.00,
            ],
            [
                'name' => 'De Lachende Spiegel',
                'description' => 'Een komedie over een spiegel die mensen aan het lachen maakt.',
                'starttime' => '2024-06-01 19:00:00',
                'endtime' => '2024-06-01 21:00:00',
                'image' => 'de_lachende_spiegel.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'price' => 15.00,
            ],
            [
                'name' => 'De Verdwenen Sleutel',
                'description' => 'Een mysterieus toneelstuk over een sleutel die plotseling verdwijnt.',
                'starttime' => '2024-07-01 19:00:00',
                'endtime' => '2024-07-01 21:00:00',
                'image' => 'de_verdwenen_sleutel.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'price' => 15.00,
            ],
            [
                'name' => 'Het Lachende Huis',
                'description' => 'Een komedie over een huis dat mensen aan het lachen maakt.',
                'starttime' => '2024-08-01 19:00:00',
                'endtime' => '2024-08-01 21:00:00',
                'image' => 'het_lachende_huis.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'price' => 15.00,
            ],
            [
                'name' => 'De Dansende Schoenen',
                'description' => 'Toneelstuk over een paar schoenen dat niet kan stoppen met dansen.',
                'starttime' => '2024-09-01 19:00:00',
                'endtime' => '2024-09-01 21:00:00',
                'image' => 'de_dansende_schoenen.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'price' => 15.00,
            ],
            [
                'name' => 'De Zingende Kat',
                'description' => 'Een muzikaal toneelstuk over een kat die prachtig kan zingen.',
                'starttime' => '2024-10-01 19:00:00',
                'endtime' => '2024-10-01 21:00:00',
                'image' => 'de_zingende_kat.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'price' => 15.00,
            ],
        ];

        foreach ($performances as $performance) {
            Performance::create([
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
