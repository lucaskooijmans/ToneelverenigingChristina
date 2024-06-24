<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\HistoryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PerformanceSeeder::class,
            PostSeeder::class,
            HistorySeeder::class,
            SponsorCategorySeeder::class,
            SponsorSeeder::class,
            BoardMemberSeeder::class,
            PhotoSeeder::class
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.nl',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
    }
}
