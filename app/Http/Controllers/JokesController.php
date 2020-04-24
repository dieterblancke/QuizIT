<?php

namespace App\Http\Controllers;

use App\Models\Joke;
use Illuminate\Http\Request;

class JokesController extends Controller
{
    public static function getRandomJoke() {
        $joke = Joke::getRandomJoke();

        return [
            'joke' => $joke->setup,
            'punchline' => $joke->punchline
        ];
    }
}
