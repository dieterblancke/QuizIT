<?php

namespace App\Http\Controllers;

use App\Models\Quizit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function joinView()
    {
        return view('join');
    }

    public function join(Request $request)
    {
        $quizID = $request->input('quizID');
        $quiz = null;

        try {
            $quiz = Quizit::findOrFail($quizID);
        } catch (Exception $e) {
            Log::error($e);

            return [
                'status' => 'error',
                'message' => 'Could not find that quiz!'
            ];
        }

        if (!$quiz->isRunning()) {
            return [
                'status' => 'error',
                'message' => 'That quiz is not active!'
            ];
        }

        return [
            'status' => 'Success',
            'message' => 'You are going to join the quiz: ' . $quiz->name
        ];
    }
}
