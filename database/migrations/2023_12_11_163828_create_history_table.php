<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizz_id');
            $table->unsignedBigInteger('selected_answer_id');
            $table->boolean('answered_correctly');
            $table->timestamps();
        
            $table->foreign('quizz_id')->references('id')->on('quizz')->onDelete('cascade');
            $table->foreign('selected_answer_id')->references('id')->on('answer')->onDelete('cascade');
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
