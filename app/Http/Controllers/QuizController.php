<?php

namespace App\Http\Controllers;

use App\Models\QuizitInstance;
use App\Models\QuizitInstanceUser;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function joinView()
    {
        return view('quiz.join');
    }

    public function join(Request $request)
    {
        $join_key = $request->input('join_key');
        $username = $request->input('username');

        try {
            $instance = QuizitInstance::getActiveInstance($join_key);

            if (is_null($username) || empty($username)) {
                return [
                    'status' => 'error',
                    'message' => 'Please provide a username'
                ];
            }

            if (is_null($instance)) {
                return [
                    'status' => 'error',
                    'message' => 'That quiz is not active - is_null'
                ];
            }

            $user = new QuizitInstanceUser;
            $user->instance_id = $instance->id;
            $user->username = $username;
            $user->position = -1;
            $user->save();

        } catch
        (\Exception $e) {
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

    public function quizView()
    {
        return view('quiz.quiz');
    }
}
