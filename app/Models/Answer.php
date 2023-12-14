<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $table = 'answer';
    
    protected $fillable = ['answer_text', 'is_correct'];

    public function quizz()
    {
        return $this->belongsTo(Quizz::class);
    }
}
