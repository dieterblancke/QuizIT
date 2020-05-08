<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizitInstance extends Model
{
    public $timestamps = false;

    public function getQuizit() {
        return Quizit::findOrFail($this->quizit_id);
    }

    public static function getActiveInstance($joinKey) {
        return self::query()->where('join_key', $joinKey)->whereNull('finished_at')->limit(1)->first();
    }
}
