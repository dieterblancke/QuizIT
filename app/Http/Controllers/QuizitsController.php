<?php

namespace App\Http\Controllers;

use App\Models\Quizit;
use App\Models\QuizitQuestion;
use App\Models\QuizitQuestionAnswer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        return view('quizits.create');
    }

    public function resultsView(int $id)
    {
        $quizit = Quizit::findOrFail($id);

        return view('quizits.results', [
            'quizit' => $quizit,
        ]);
    }

    public function editView(int $id)
    {
        $quizit = Quizit::findOrFail($id);

        return view('quizits.edit', [
            'quizit' => $quizit,
        ]);
    }

    public function start(int $quizitId)
    {
        //TODO: Start a quiz
        $quizit = Quizit::findOrFail($quizitId);
        $quizit->start();

        return [
            'status' => 'success',
            'message' => "Quiz was activated successfully!",
        ];
    }

    public function stop(int $quizitId)
    {
        /** @var Quizit $quizit */
        $quizit = Quizit::findOrFail($quizitId);
        if ($quizit->stop()) {
            return [
                'status' => 'success',
                'message' => "Quiz was deactivated successfully!",
            ];
        } else {
            return [
                'status' => 'error',
                'message' => "Quiz could not be stopped, try again later!",
            ];
        }
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $questions = $request->input('questions');

        try {
            $quizit = new Quizit();
            $quizit->name = $name;
            $quizit->author_id = Auth::user()->id;
            $quizit->active = false;
            $quizit->key = Str::random(8);
            $quizit->save();

            $this->saveQuestions($quizit->id, $questions);
        } catch (Exception $e) {
            Log::error($e);

            return [
                'status' => 'error',
                'message' => 'Could not create quizit! Please try again later.',
            ];
        }
        return [
            'status' => 'success',
            'message' => 'Quizit was created successfully!',
        ];
    }

    public function update(Request $request, int $id)
    {
        $name = $request->input('name');
        $questions = $request->input('questions');

        try {
            /** @var Quizit $quizit */
            $quizit = Quizit::findOrFail($id);

            $quizit->name = $name;
            $quizit->questions()->delete();
            $quizit->save();

            $this->saveQuestions($quizit->id, $questions);
        } catch (Exception $e) {
            Log::error($e);

            return [
                'status' => 'error',
                'message' => 'Could not update quizit! Please try again later.',
            ];
        }
        return [
            'status' => 'success',
            'message' => 'Quizit was updated successfully!',
        ];
    }

    public function delete(int $id)
    {
        try {
            /** @var Quizit $quizit */
            $quizit = Quizit::findOrFail($id);
            $quizit->delete();
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Could not delete quizit! Please try again later.',
            ];
        }
        return [
            'status' => 'success',
            'message' => 'Quizit was deleted successfully!',
        ];
    }

    /**
     * @param $quizitId
     * @param $questions
     */
    private function saveQuestions($quizitId, $questions)
    {
        foreach ($questions as $question) {
            if (empty($question['answers'])) {
                continue;
            }

            $dbQuestion = new QuizitQuestion();
            $dbQuestion->quizit_id = $quizitId;
            $dbQuestion->question = $question['question'];
            $dbQuestion->save();

            foreach ($question['answers'] as $answer) {
                $dbAnswer = new QuizitQuestionAnswer();
                $dbAnswer->question_id = $dbQuestion->id;
                $dbAnswer->answer = $answer['answer'] ?? '';
                $dbAnswer->correct = $answer['correct'];
                $dbAnswer->save();
            }
        }
    }
}
