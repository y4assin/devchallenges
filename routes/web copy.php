<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/google-auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    });

    Route::get('/google-auth/callback', function () {
        $user = Socialite::driver('google')->user();
        dd($user);
         });


         Route::get('/github-auth/redirect', function () {
            return Socialite::driver('github')->redirect();
        });

        Route::get('/auth/callback', function () {
            $user = Socialite::driver('github')->user();
             });

});
