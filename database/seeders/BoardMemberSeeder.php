<?php

namespace Database\Seeders;

use App\Models\BoardMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardMembers = [
            [
                'id' => 1,
                'name' => 'Vivian Baauw – Voorzitter',
                'email' => 'vivian@gmail.com',
                'phone' => '06-12345678',
                'description' => '<strong>In het bestuur bij Toneelvereniging Christina sinds 2022</strong>' . '<br/>' . '“In 2018 had ik mijn eerste debuut bij de toneelvereniging en speelde ik mee in het stuk ‘De erfenis van Tante Bella’. Mijn vader speelde ook mee (en vroeger speelde hij ook samen met zijn vader), heel leuk om de familie traditie voort te zetten. Ik heb 3 keer meegespeeld en na het stuk in september 2022 ben ik gevraagd voor het bestuur. Sinds oktober 2023 heb ik de rol van voorzitter op me genomen. Het leukste van mijn bestuurstaken vind ik het (online) ontwikkelen van de vereniging en het betrokken zijn bij de spelersgroep – het is elk seizoen weer een feestje om naar een mooie uitvoering te werken.”',
                'image_url' => '../images/vivian.png'
            ],
            [
                'id' => 2,
                'name' => 'Marianne van Veen - Secretaris',
                'email' => 'marianne@gmail.com',
                'phone' => '06-12345678',
                'description' => '<strong>In het bestuur bij Toneelvereniging Christina sinds 2009</strong>' . '<br/>' . '“In 1992 speelde ik voor de eerste keer toneel bij de toneelvereniging in Asch en 17 jaar later voor het eerst bij toneelvereniging Christina. Ik heb al 11 keer meegespeeld bij de vereniging en vind het heerlijk om mee te spelen met een stuk, maar ook om te souffleren of regisseren. Sinds 2009 wonen we in Ravenswaaij en ben ik ook het bestuur ingestapt. Het leukste van mijn taak als secretaris vind ik het bewaken van de agenda en het uitkiezen van een toneelstuk en de bijbehorende spelers selecteren en benaderen.”',
                'image_url' => '../images/marianne.png'
            ],
            [
                'id' => 3,
                'name' => 'Hans van Veen – Penningmeester',
                'email' => 'hans@gmail.com',
                'phone' => '06-12345678',
                'description' => '<strong>In het bestuur bij Toneelvereniging Christina sinds 2009</strong>' . '<br/>' . '“In 2008 heb ik voor het eerst meegespeeld bij de vereniging en een paar jaar later (2011) ben ik begonnen als bestuurslid. In 2015 heb ik de functie van penningmeester op me genomen. In mijn rol binnen de vereniging zorg ik ervoor dat de het kasboek klopt, de kaartverkoop goed geregistreerd en uitgevoerd wordt, de verloting goed loopt, enz. Het leukste van mijn functie vind ik het manusje van alles zijn en als het nodig is dan speel ik ook wel eens een rol in een uitvoering. Ik heb sinds het begin ongeveer 7 keer meegespeeld in een toneelstuk.”',
                'image_url' => '../images/hans.png'
            ],
            [
                'id' => 4,
                'name' => 'Angela de Vos – Bestuurslid',
                'email' => 'angela@gmail.com',
                'phone' => '06-12345678',
                'description' => '<strong>In het bestuur bij Toneelvereniging Christina sinds 2015</strong>' . '<br/>' . '“In 2010 speelde ik voor het eerst mee met het stuk ‘Het Veenspook’. 5 jaar later ben ik ook in het bestuur gekomen – ik ben opgegroeid in Ravenswaaij en vind het leuk om bij het dorp betrokken te blijven. In totaal heb ik zo’n 6 keer meegespeeld. Het leukste aan spelen vind ik het met zijn alle toewerken naar een mooie voorstelling en een ‘rol’ te kunnen spelen. Qua bestuur vind ik het leuk om zo veel mogelijk bekendheid te geven aan de vereniging in ons kleine dorpje en het zorgdragen voor een mooi toneelstuk.”',
                'image_url' => '../images/angela.png'
            ],
            [
                'id' => 5,
                'name' => 'Diana van Oort – Bestuurslid',
                'email' => 'diana@gmail.com',
                'phone' => '06-12345678',
                'description' => '<strong>In het bestuur bij Toneelvereniging Christina sinds 2022</strong>' . '<br/>' . '“Als speler ben ik begonnen in mei/juni in seizoen 2022. Na dit stuk ben ik ook gaan meehelpen in het bestuur, heb ik 2 keer meegespeeld en ben ik ook souffleuse geweest. Het mooiste van deze groep is de saamhorigheid en de gezelligheid, zowel in de spelersgroep als in het bestuur. Het is altijd weer even afkicken als de uitvoeringen er weer opzitten!”',
                'image_url' => '../images/diana.png'
            ],
        ];

        foreach ($boardMembers as $boardMember) {
            BoardMember::create([
                'id' => $boardMember['id'],
                'name' => $boardMember['name'],
                'email' => $boardMember['email'],
                'phone' => $boardMember['phone'],
                'description' => $boardMember['description'],
                'image_url' => $boardMember['image_url']
            ]);
        }
    }
}
