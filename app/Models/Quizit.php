<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quizit extends Model
{
    /**
     * @return HasMany
     */
    public function questions() {
        return $this->hasMany(QuizitQuestion::class);
    }
}
