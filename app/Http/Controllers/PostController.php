<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){

        return view('posts.index',[
            'posts' => Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(3)->withQueryString(),
        ]);
    }//index 

    public function show(Post $post){

        return view('posts.show', compact('post'));
    }//post

    public function create(){

        return view('posts.create');

    }//create

    public function store(){
        
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required' , Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();

        $attributes['thumbnail'] = request()->file('thumbnail')->store('public/thumbnails');

        $attributes['thumbnail'] = Str::after($attributes['thumbnail'], 'public/');

        Post::create($attributes);

        return redirect('/');
    }//store

}
