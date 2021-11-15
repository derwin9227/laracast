<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(){
    
        return view('posts.index',[
            'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
        ]);
    }//index

    public function show(Post $post){

        return view('post.show', compact('post'));
    }//post

}
