<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizitInstanceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizit_instance_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizit_id');
            $table->string('username');
            $table->string('ip');
            $table->integer('position');
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
        Schema::dropIfExists('quizit_instance_users');
    }
}
