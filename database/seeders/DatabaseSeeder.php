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
        // \App\Models\User::factory(10)->create();
        $historyItemData = HistoryItem::factory()->make()->toArray();
        HistoryItem::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Post::create(
            [
                'title' => 'Post 1',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing'
            ]
        );

        Post::create(
            [
                'title' => 'Post 2',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing'
            ]
        );

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.nl',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
    }
}
