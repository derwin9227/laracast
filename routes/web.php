<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::get('/', function () {

    $posts = Post::all();

    return view('posts',[
        'posts' => $posts
    ]);

});

Route::get('posts/{post}', function($id) {

    $post = Post::findOrFail($id);

    return view('post',[
        'post' => Post::find($id)
    ]);

});