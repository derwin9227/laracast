<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index(){
        return view('admin.posts.index', [
        'posts' => Post::paginate(50)
        ]);
    }//index

    public function create(){

        return view('admin.posts.create');

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

    public function edit(Post $post){
        return view('admin.posts.edit', ['post' => $post]);
    }//edit

    public function update(Post $post){

        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required' , Rule::exists('categories', 'id')]
        ]);

        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('public/thumbnails');

            $attributes['thumbnail'] = Str::after($attributes['thumbnail'], 'public/');
        }//if thumbnail

        $post->update($attributes);

        return back()->with('success', 'Post Updated');

    }//update

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'Post Deleted');
    }
}
