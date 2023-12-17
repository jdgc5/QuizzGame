<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('game_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); 
            $table->string('user_name'); 
            $table->integer('score'); 
            $table->dateTime('played_at'); 
            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('game_history');
    }
};