<?php

namespace App\Http\Controllers;

use App\Models\Quizit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizitsController extends Controller
{
    public function index()
    {
        $quizits = Auth::user()->quizits;

        return view('home', [
            'quizits' => $quizits
        ]);
    }

    public function createView()
    {
        return view('create');
    }

    public function create(Request $request) {
        return [];
    }
}
