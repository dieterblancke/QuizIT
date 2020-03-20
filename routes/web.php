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
    });

/**
 * User Routes
 */
Route::prefix('quizits')
    ->as('quizits.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'QuizitsController@index')->name('index');
        Route::prefix('create')
            ->as('create')
            ->group(function () {
                Route::get('/', 'QuizitsController@createView');
                Route::post('/', 'QuizitsController@create');
            });
    });
