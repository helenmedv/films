<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title', 'year', 'image', 'description'
    ];

    function genres(){
        return $this->belongsToMany(Genre::class, 'genre_film');
    }

    function actors(){
        return $this->belongsToMany(Actor::class, 'actor_film');
    }
}
