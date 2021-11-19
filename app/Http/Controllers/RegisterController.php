<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }//create

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|min:7|max:255',
            //'password' => ['required', 'min|7', 'max:255']
        ]);
        
        /* User::create([
            'name' => $attributes['name'],
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'password' => $attributes['password']
        ]); */

        /* se puede reemplazar por una funcion en el modelo user
        $attributes['password'] = bcrypt($attributes['password']); */

        User::create($attributes);

        return redirect('/');
    }//store
}
