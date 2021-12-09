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

}
