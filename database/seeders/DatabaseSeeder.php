<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
<<<<<<< HEAD
use App\Models\HistoryItem;
=======
use App\Models\Post;
use App\Models\User;
>>>>>>> developer
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // \App\Models\User::factory(10)->create();
        $historyItemData = HistoryItem::factory()->make()->toArray();
        HistoryItem::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
=======
        Post::create(
            [
                'title' => 'Post 1',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Justo laoreet sit amet cursus sit amet. Viverra nibh cras pulvinar mattis nunc sed blandit libero. Sed tempus urna et pharetra pharetra massa. Iaculis nunc sed augue lacus viverra vitae. Integer eget aliquet nibh praesent tristique magna sit amet purus. Vel facilisis volutpat est velit egestas. Feugiat nibh sed pulvinar proin gravida hendrerit. Purus faucibus ornare suspendisse sed nisi lacus sed viverra tellus. Risus commodo viverra maecenas accumsan lacus. Sed libero enim sed faucibus. Lobortis feugiat vivamus at augue eget arcu. Amet facilisis magna etiam tempor orci eu lobortis. Et ligula ullamcorper malesuada proin. Sed viverra ipsum nunc aliquet bibendum enim. Consequat ac felis donec et odio pellentesque. Adipiscing at in tellus integer feugiat scelerisque varius morbi enim. Tellus integer feugiat scelerisque varius morbi enim nunc faucibus a. Lectus quam id leo in vitae turpis massa sed elementum. Auctor elit sed vulputate mi sit amet mauris.'
            ]
        );

        Post::create(
            [
                'title' => 'Post 2',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Justo laoreet sit amet cursus sit amet. Viverra nibh cras pulvinar mattis nunc sed blandit libero. Sed tempus urna et pharetra pharetra massa. Iaculis nunc sed augue lacus viverra vitae. Integer eget aliquet nibh praesent tristique magna sit amet purus. Vel facilisis volutpat est velit egestas. Feugiat nibh sed pulvinar proin gravida hendrerit. Purus faucibus ornare suspendisse sed nisi lacus sed viverra tellus. Risus commodo viverra maecenas accumsan lacus. Sed libero enim sed faucibus. Lobortis feugiat vivamus at augue eget arcu. Amet facilisis magna etiam tempor orci eu lobortis. Et ligula ullamcorper malesuada proin. Sed viverra ipsum nunc aliquet bibendum enim. Consequat ac felis donec et odio pellentesque. Adipiscing at in tellus integer feugiat scelerisque varius morbi enim. Tellus integer feugiat scelerisque varius morbi enim nunc faucibus a. Lectus quam id leo in vitae turpis massa sed elementum. Auctor elit sed vulputate mi sit amet mauris.'
            ]
        );

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.nl',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
>>>>>>> developer
    }
}
