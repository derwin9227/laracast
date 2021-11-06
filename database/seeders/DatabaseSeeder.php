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
        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);
        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

       Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My Family Post',
            'slug' => 'my-family-post',
            'excerpt' => '<p>lorem ipsum dolar sit amet.</p>',
            'body' => '<p>lorem ipsum dolor sit amet.</p>'
        ]);

        Post::create([
            'user_id' => $work->id,
            'category_id' => $work->id,
            'title' => 'My work Post',
            'slug' => 'my-work-post',
            'excerpt' => '<p>lorem ipsum dolar sit amet.</p>',
            'body' => '<p>lorem ipsum dolor sit amet.</p>'
        ]);
    }
}
