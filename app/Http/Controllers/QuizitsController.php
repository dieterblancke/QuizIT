<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizitsController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function createView()
    {
        return view('create');
    }

    public function create() {
        return [];
    }
}
