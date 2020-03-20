<?php

namespace App\Http\Controllers;

class QuizController extends Controller
{
    public function joinView()
    {
        return view('join');
    }

    public function join()
    {
        return [];
    }
}
