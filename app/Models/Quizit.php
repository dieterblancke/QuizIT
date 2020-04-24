<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Quizit extends Model
{
    protected $with = ['questions'];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return HasMany
     */
    public function questions()
    {
        return $this->hasMany(QuizitQuestion::class, 'quizit_id');
    }

    /**
     * @return HasMany
     */
    public function instances()
    {
        return $this->hasMany(QuizitInstance::class);
    }

    /**
     * @eturn bool
     */
    public function isRunning()
    {
        return $this->instances()->whereNull('finished_at')->exists();
    }

    /**
     * @return QuizitInstance|Model
     */
    public function getRunningQuiz()
    {
        return $this->instances()->whereNull('finished_at')->first();
    }

    /**
     * @return string
     */
    public function start()
    {
        if ($this->isRunning()) {
            return $this->getRunningQuiz()->join_key;
        } else {
            $instance = new QuizitInstance();
            $instance->quizit_id = $this->getAttribute('id');
            $instance->join_key = Str::random(6);
            $instance->started_at = Carbon::now();
            $instance->save();

            return $instance->join_key;
        }
    }

    /**
     * @return bool
     */
    public function stop()
    {
        if ($this->isRunning()) {
            $quiz = $this->getRunningQuiz();
            $quiz->finished_at = Carbon::now();
            $quiz->save();

            return true;
        }
        return false;
    }

    /**
     * @return QuizitInstance|HasMany|object|null
     */
    public function getRunningQuizit()
    {
        return $this->instances()->whereNull('finished_at')->limit(1)->first();
    }
}
