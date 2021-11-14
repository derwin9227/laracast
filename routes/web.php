<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::get('/', function () {
    
    $post = Post::latest();

    if(request('search')){
        $post
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
    }

    return view('posts',[
        'posts' => $post->get(),
        'categories' => Category::all()    ]);

})->name('home');

Route::get('posts/{post:slug}', function(Post $post) {

    return view('post',[
        'post' => $post
    ]);

});

Route::get('categories/{category:slug}', function(Category $category) {

    return view('posts',[
        'posts' => $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);

})->name('category');

Route::get('authors/{author:username}', function (User $author){
    
    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
});