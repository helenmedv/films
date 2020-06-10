<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::redirect('/', '/films');

Route::middleware('auth')
    ->group(function (){

        Route::resource('films', 'FilmController');
        Route::resource('genres', 'GenreController');
        Route::resource('actors', 'ActorController');
});

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);


