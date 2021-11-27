<?php

use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

use App\Models\Post;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::post('/newsletter', function () {
    request()->validate([
        'email' => 'required|email',
    ]);

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us20'
    ]);

    try{
        $response = $mailchimp->lists->addListMember("943edcfba1", [
            "email_address" => request('email'),
            "status" => "subscribed",
        ]);
    }
    catch(\Exception $e){
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added to or newsletter list.'
        ]);
    }
   
    return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
});

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');

Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');