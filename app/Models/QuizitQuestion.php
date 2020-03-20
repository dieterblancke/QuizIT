<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizitQuestion extends Model
{
    /**
     * @return BelongsTo
     */
    public function quizit()
    {
        return $this->belongsTo(Quizit::class);
    }

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(QuizitQuestionAnswers::class);
    }
}
