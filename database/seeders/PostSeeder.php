<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Welkom bij onze blog',
                'body' => 'Dit is onze eerste blogpost! Blijf ons volgen voor meer updates.',
            ],
            [
                'title' => 'Aankomende evenementen',
                'body' => 'Bekijk onze lijst met aankomende evenementen. We hopen je daar te zien!',
            ],
            [
                'title' => 'De Magie van Toneel',
                'body' => 'Ontdek de magie van toneel en hoe het ons kan vervoeren naar nieuwe werelden.',
            ],
            [
                'title' => 'Onze Gemeenschap',
                'body' => 'Lees meer over onze geweldige gemeenschap en hoe je er deel van kunt uitmaken.',
            ],
            [
                'title' => 'Achter de Schermen',
                'body' => 'Een exclusieve blik achter de schermen bij onze laatste productie.',
            ],
            [
                'title' => 'De Kracht van Verhalen',
                'body' => 'Verken de kracht van verhalen en hoe ze ons kunnen inspireren en motiveren.',
            ]
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'body' => $post['body'],
            ]);
        }
    }
}
