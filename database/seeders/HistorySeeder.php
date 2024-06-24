<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoryItem;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $historyItems = [
            [
                'header' => 'De Oprichting',
                'optional_text_one' => 'Onze toneelvereniging werd opgericht in 1974.',
                'image_path' => 'oprichting.jpg',
                'optional_text_two' => 'Het was een groep enthousiaste toneelliefhebbers die samenkwamen om hun passie te delen.',
                'optional_footer' => 'We zijn sindsdien blijven groeien en evolueren.',
            ],
            [
                'header' => 'Eerste Voorstelling',
                'optional_text_one' => 'Onze eerste voorstelling vond plaats in 1975.',
                'image_path' => 'eerste_voorstelling.jpg',
                'optional_text_two' => 'Het was een groot succes en een belangrijke mijlpaal voor onze vereniging.',
                'optional_footer' => 'We kijken met trots terug op deze prestatie.',
            ],
            [
                'header' => '50-jarig Jubileum',
                'optional_text_one' => 'In 2024 vierden we ons 50-jarig jubileum met een speciale voorstelling.',
                'image_path' => 'jubileum_50.jpg',
                'optional_text_two' => 'Het was een mijlpaal die we nooit zullen vergeten.',
                'optional_footer' => 'We kijken uit naar de volgende 50 jaar!',
                'milestone' => 1,
                'contribution' => 0,
            ],
            [
                'header' => 'Nieuwe Theaterzaal',
                'optional_text_one' => 'In 2000 openden we onze nieuwe theaterzaal.',
                'image_path' => 'nieuwe_theaterzaal.jpg',
                'optional_text_two' => 'Dit was een belangrijke bijdrage aan onze gemeenschap.',
                'optional_footer' => 'We zijn trots op deze prestatie.',
                'milestone' => 0,
                'contribution' => 1,
            ],
            [
                'header' => '100ste Voorstelling',
                'optional_text_one' => 'In 2024 hebben we onze 100ste voorstelling geproduceerd.',
                'image_path' => '100ste_voorstelling.jpg',
                'optional_text_two' => 'Dit was een belangrijke mijlpaal in onze geschiedenis.',
                'optional_footer' => 'We zijn dankbaar voor de voortdurende steun van onze gemeenschap.',
                'milestone' => 1,
                'contribution' => 0,
            ],
            [
                'header' => 'Theaterworkshops voor Kinderen',
                'optional_text_one' => 'Sinds 2019 bieden we theaterworkshops aan voor kinderen in onze gemeenschap.',
                'image_path' => 'theaterworkshops.jpg',
                'optional_text_two' => 'Dit is een belangrijke bijdrage aan de ontwikkeling van jong talent.',
                'optional_footer' => 'We zijn toegewijd aan het koesteren van de volgende generatie artiesten.',
                'milestone' => 0,
                'contribution' => 1,
            ]
            
        ];

        foreach ($historyItems as $item) {
            HistoryItem::create([
                'header' => $item['header'],
                'optional_text_one' => $item['optional_text_one'],
                'video_path' => $item['video_path'] ?? null,
                'image_path' => $item['image_path'] ?? null,
                'optional_text_two' => $item['optional_text_two'] ?? null,
                'optional_footer' => $item['optional_footer'] ?? null,
                'milestone' => $item['milestone'] ?? 0,
                'contribution' => $item['contribution'] ?? 0,
            ]);
        }
    }
}
