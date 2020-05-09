<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizitResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizit_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizit_id');
            $table->string('username');
            $table->integer('score');
            $table->integer('total');
            $table->timestamps();

            $table
                ->foreign('quizit_id')
                ->references('id')
                ->on('quizits')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizit_results');
    }
}
