<?php

/** @var Factory $factory */

use App\Models\Quizit;
use App\Models\QuizitQuestion;
use App\Models\QuizitQuestionAnswer;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Quizit::class, function (Faker $faker) {
    static $i = 0;
    $i++;

    return [
        'name' => $faker->name,
        'author_id' => $i,
        'amount_started' => $faker->numberBetween(0, 150),
    ];
});

$factory->define(QuizitQuestion::class, function (Faker $faker) {
    return [
        'question' => $faker->realText(25),
    ];
});

$factory->define(QuizitQuestionAnswer::class, function (Faker $faker) {
    return [
        'answer' => $faker->realText(25),
        'correct' => $faker->boolean,
    ];
});
