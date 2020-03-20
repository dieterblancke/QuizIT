<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizitInstanceUserQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizit_instance_user_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instance_user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->timestamps();

            $table
                ->foreign('instance_user_id')
                ->references('id')
                ->on('quizit_instance_users')
                ->onDelete('cascade');

            $table
                ->foreign('question_id')
                ->references('id')
                ->on('quizit_questions')
                ->onDelete('cascade');

            $table
                ->foreign('answer_id')
                ->references('id')
                ->on('quizit_question_answers')
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
        Schema::dropIfExists('quizit_instance_user_questions');
    }
}
