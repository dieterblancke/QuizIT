<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quizit extends Model
{
    protected $with = ['questions'];

    public function user() {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return HasMany
     */
    public function questions() {
        return $this->hasMany(QuizitQuestion::class, 'quizit_id');
    }
}
