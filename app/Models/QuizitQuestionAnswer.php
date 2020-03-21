<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizitQuestionAnswer extends Model
{
    /**
     * @return BelongsTo
     */
    public function question() {
        return $this->belongsTo(QuizitQuestion::class, 'question_id');
    }
}
