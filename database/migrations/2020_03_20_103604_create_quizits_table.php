<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('author_id');
            $table->integer('amount_started')->default(0);
            $table->timestamps();

            $table
                ->foreign('author_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('quizits');
    }
}