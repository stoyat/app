<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');

Route::resource('books', 'BookController');

Route::resource('bookregister', 'RegisterController');

Route::resource('home', 'HomeController');

Route::auth();

Route::get('login/{provider}', function ($provider){
    return Socialite::driver($provider)->redirect();
});

Route::get('auth/{provider}/callback', function ($provider){
    $user = Socialite::driver($provider)->user();

    if(!$LibraryUser = App\User::where('email', $user->email )->first())
        $LibraryUser = App\User::create([
            'firstname' => explode(' ', $user->name)[0],
            'lastname' => explode(' ', $user->name)[1],
            'email' => $user->email,
        ]);

    Auth::login($LibraryUser, true);

    return Redirect::to('home');
});