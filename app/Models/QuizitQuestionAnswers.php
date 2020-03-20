<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizitQuestionAnswers extends Model
{
    protected $with = ['question'];

    /**
     * @return BelongsTo
     */
    public function question() {
        return $this->belongsTo(QuizitQuestion::class);
    }
}
