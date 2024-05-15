<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = [
            [
                'id' => 1,
                'image' => '../images/Eerste_Groepsfoto.jpg',
                'title' => 'Eerste groepsfoto',
                'description' => 'De allereerste groepsfoto uit 1962'
            ],
            [
                'id' => 2,
                'image' => '../images/Het_Veenspook.jpg',
                'title' => 'Het Veenspook',
                'description' => ''
            ],
            [
                'id' => 3,
                'image' => '../images/Boerenbedrog_1998.jpg',
                'title' => 'Boerenbedrog 1998',
                'description' => ''
            ],
            [
                'id' => 4,
                'image' => '../images/Groepsfoto_2014.jpg',
                'title' => 'Groepsfoto 2014',
                'description' => ''
            ],
            [
                'id' => 5,
                'image' => '../images/Crew_2018_2019.jpg',
                'title' => 'Crew 2018-2019',
                'description' => ''
            ],
            [
                'id' => 6,
                'image' => '../images/Bloody_Mary.jpg',
                'title' => 'Bloody Mary',
                'description' => ''
            ],
        ];

        foreach ($photos as $photo) {
            Photo::create([
                'id' => $photo['id'],
                'image' => $photo['image'],
                'title' => $photo['title'],
                'description' => $photo['description']
            ]);
        }
    }
}
