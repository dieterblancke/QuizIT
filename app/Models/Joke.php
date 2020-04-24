<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joke extends Model
{
    public static function getRandomJoke() {
        return self::all()->random();
    }
}
