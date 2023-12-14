<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;
    
    protected $table = 'quizz';
    
    protected $fillable = ['question'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
        public function correctAnswer()
    {
        return $this->hasOne(Answer::class)->where('is_correct', true);
    }
    
    
}
