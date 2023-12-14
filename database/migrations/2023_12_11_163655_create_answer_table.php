<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizz_id')->nullable(false); 
            $table->string('answer_text', 300)->nullable(false);
            $table->boolean('is_correct')->nullable(false);

            $table->timestamps();

            $table->foreign('quizz_id')->references('id')->on('quizz')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    
    public function quizz()
    {
    return $this->belongsTo(Quizz::class);
    }
    

    public function down(): void
    {
        Schema::dropIfExists('answer');
    }
};
