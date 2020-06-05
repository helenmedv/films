<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::redirect('/', '/films');

//Route::middleware('auth')
 //   ->group(function (){

        Route::resource('films', 'FilmController');
        Route::resource('genres', 'GenreController');
        Route::resource('actors', 'ActorController');

//    });
