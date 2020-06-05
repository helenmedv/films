<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
    ];

    function films() {
        return $this->belongsToMany(Film::class, 'genre_film');
    }
}
