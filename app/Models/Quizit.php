<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quizit extends Model
{
    protected $with = ['questions'];

    public static function getByKey($join_key)
    {
        return self::query()->where('key', $join_key)->where('active', true)->first();
    }

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
    public function results()
    {
        return $this->hasMany(QuizitResults::class, 'quizit_id');
    }

    /**
     * @return string
     */
    public function start()
    {
        $this->active = true;
        $this->save();

        return $this->key;
    }

    /**
     * @return bool
     */
    public function stop()
    {
        $this->active = false;
        $this->save();
        return true;
    }
}
