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
                'name' => 'Familie van der steen',
                'description' => 'Een verhaal over familie van der steen.',
                'starttime' => '2024-05-01 19:00:00',
                'endtime' => '2024-05-01 21:00:00',
                'image' => 'familie_van_der_steen.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'tickets_added' => 100,
                'price' => 10,
            ],
            [
                'name' => 'Niet parkeren op het terras',
                'description' => 'Een eigenzinnige voorstelling.',
                'starttime' => '2024-06-01 19:00:00',
                'endtime' => '2024-06-01 21:00:00',
                'image' => 'niet_parkeren_op_het_terras.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'tickets_added' => 100,
                'price' => 10,
            ],
            [
                'name' => 'Verkeerde hulp op de eerste hulp',
                'description' => 'Een komische kijk op medische misverstanden.',
                'starttime' => '2024-07-01 19:00:00',
                'endtime' => '2024-07-01 21:00:00',
                'image' => 'verkeerde_hulp_op_de_eerste_hulp.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'tickets_added' => 100,
                'price' => 10,
            ],
            [
                'name' => 'Zomer in zeeland',
                'description' => 'Een zomers toneelstuk over Zeeland.',
                'starttime' => '2024-08-01 19:00:00',
                'endtime' => '2024-08-01 21:00:00',
                'image' => 'zomer_in_zeeland.jpg',
                'location' => 'Dorpshuis de Rozenhoek',
                'available_seats' => 100,
                'tickets_remaining' => 100,
                'tickets_added' => 100,
                'price' => 10,
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
                'tickets_added' => $performance['tickets_added'],
                'price' => $performance['price'],
            ]);
        }
    }
}
