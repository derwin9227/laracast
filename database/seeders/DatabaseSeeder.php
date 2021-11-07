<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Jhon Doe'
        ]);
        
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

    }
}
