<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizitQuestion extends Model
{
    protected $with = ['answers'];

    /**
     * @return BelongsTo
     */
    public function quizit()
    {
        return $this->belongsTo(Quizit::class, 'quizit_id');
    }

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(QuizitQuestionAnswer::class, 'question_id')->inRandomOrder();
    }

    public function getCorrectAnswerCount() {
        return $this->answers()->where('correct', '=', true)->count();
    }
}
