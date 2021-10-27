<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts');
});

Route::get('posts/{post}', function($slug) {
    

    if(! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")){
        return redirect('/');
    }

    $post = cache()->remember("posts.{$slug}", 5/* segundos o now()->addminutes(10) */, fn() => file_get_contents($path));

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+');
//whereAlpha('post');