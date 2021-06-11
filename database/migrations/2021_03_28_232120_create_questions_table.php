<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text')->unique();
            $table->string('question_image')->nullable();
            $table->text('answer_a');
            $table->text('answer_b');
            $table->text('answer_c');
            $table->enum('correct_answer',['A','B','C']);
            $table->integer('user_id');
            $table->integer('video_number')->nullable();
            $table->enum('question_level',['متوسط','صعب'])->nullable();
            $table->integer('primary_question_id')->nullable();
            $table->integer('course_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question');
    }
}
