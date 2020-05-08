<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth Routes
 */
Auth::routes();

/**
 * Guest Routes
 */
Route::prefix('/')
    ->group(function () {
        Route::get('/', function () {
            return view('index');
        });

        Route::prefix('join')
            ->group(function () {
                Route::get('/', 'QuizController@joinView');
                Route::post('/', 'QuizController@join')->name('join');
            });
        Route::prefix('quiz')
            ->as('quiz.')
            ->group(function () {
                Route::get('/{join_key}', 'QuizController@quizView');
                Route::post('/submit/{quiz_id}', 'QuizController@submit');
            });
    });

/**
 * User Routes
 */
Route::prefix('quizits')
    ->as('quizits.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'QuizitsController@index')->name('index');

        Route::prefix('/create')
            ->group(function() {
                Route::get('/', 'QuizitsController@createView');
                Route::post('/', 'QuizitsController@create')->name('create');
            });

        Route::get('/edit/{id}', 'QuizitsController@editView')->name('edit');
        Route::put('/update/{id}', 'QuizitsController@update');
        Route::delete('/delete/{id}', 'QuizitsController@delete');

        Route::put('/start/{id}', 'QuizitsController@start');
        Route::put('/stop/{id}', 'QuizitsController@stop');

        Route::put('/create/{id}', 'QuizitsController@createInstance');
    });
