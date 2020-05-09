<?php

namespace App\Http\Controllers;

use App\Models\Quizit;
use App\Models\QuizitQuestionAnswer;
use App\Models\QuizitResults;
use Exception;
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
            if (is_null($username) || empty($username)) {
                return [
                    'status' => 'error',
                    'message' => 'Please provide a username'
                ];
            }

            $quizit = Quizit::getByKey($join_key);

            if (is_null($quizit)) {
                return [
                    'status' => 'error',
                    'message' => 'That quiz is not active.'
                ];
            }

            $request->session()->put('username', $username);
            $request->session()->put('quiz', $quizit->id);
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

    public function quizView(Request $request, string $join_key)
    {
        $quizit = Quizit::getByKey($join_key);

        if (is_null($quizit)) {
            return redirect('/');
        }

        return view('quiz.quiz', ['quizit' => $quizit]);
    }

    public function submit(Request $request, int $quizId)
    {
        /** @var Quizit $quizit */
        $quizit = Quizit::findOrFail($quizId);

        if (is_null($quizit)) {
            return redirect('/');
        }
        $givenAnswers = $request->post();
        $results = [];
        $correct = 0;

        foreach ($quizit->questions as $question) {
            $correctAnswers = $question->getCorrectAnswers();

            if (array_key_exists('question_' . $question->id, $givenAnswers)) {
                $givenAnswer = QuizitQuestionAnswer
                    ::query()
                    ->where('id', '=', $givenAnswers['question_' . $question->id])
                    ->first();
                $isCorrect = $question->isCorrect($givenAnswers['question_' . $question->id]);

                if ($isCorrect) $correct++;

                $results[] = (object) [
                    'question' => $question,
                    'givenAnswer' => $givenAnswer->answer ?? '',
                    'correctAnswers' => $correctAnswers,
                    'answers' => $question->answers()->get(),
                    'correct' => $isCorrect,
                ];
            } else {
                $results[] = (object) [
                    'question' => $question,
                    'givenAnswer' => '',
                    'correctAnswers' => $correctAnswers,
                    'answers' => $question->answers()->get(),
                    'correct' => false,
                ];
            }
        }

        $quizitResult = new QuizitResults();
        $quizitResult->quizit_id = $quizit->id;
        $quizitResult->username = $request->session()->get('username');
        $quizitResult->score = $correct;
        $quizitResult->total = $quizit->questions->count();
        $quizitResult->save();

        return view('quiz.result', [
            'quizit' => $quizit,
            'results' => (object) $results,
            'score' => $correct . ' / ' . $quizit->questions->count(),
        ]);
    }
}
