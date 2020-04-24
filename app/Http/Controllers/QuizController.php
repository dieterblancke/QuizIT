<?php

namespace App\Http\Controllers;

use App\Models\Quizit;
use App\Models\QuizitInstance;
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
        $join_key = $request->input('join_key');

        try {
            $instance = QuizitInstance::getActiveInstance($join_key);

            if (is_null($instance)) {
                return [
                    'status' => 'error',
                    'message' => 'That quiz is not active'
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'That quiz is not active'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'You will be redirected to the quiz'
        ];
    }

    public function quizView() {

    }
}
