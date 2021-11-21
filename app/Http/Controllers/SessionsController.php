<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create(){
        return view('sessions.create');
    }//create

    public function store(){

        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(! auth()->attempt($attributes)){

            throw ValidationException::withMessages([
                'email' => 'Your provided credentials coud not be verified.'
            ]);
        }//if

        session()->regenerate();

        return redirect('/')->with('success', 'welcome Back');

    }//store

    public function destroy(){
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }//logout
}
