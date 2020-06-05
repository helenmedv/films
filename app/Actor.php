<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'fio',
    ];

    function films(){
        return $this->belongsToMany(Film::class, 'actor_film');
    }
}
