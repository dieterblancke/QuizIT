<?php

use App\Models\Quizit;
use App\Models\QuizitQuestion;
use App\Models\QuizitQuestionAnswer;
use App\User;
use Illuminate\Database\Seeder;

class QuizitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $quizits = factory(Quizit::class)->times(5)->create(['author_id' => $user->id]);

            foreach ($quizits as $quizit) {
                $questions = factory(QuizitQuestion::class)->times(8)->create(['quizit_id' => $quizit->id]);

                foreach ($questions as $question) {
                    factory(QuizitQuestionAnswer::class)->times(4)->create(['question_id' => $question->id]);
                }
            }
        }
    }
}
