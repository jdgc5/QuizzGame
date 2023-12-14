<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'question_id',
        'answered_correctly',
    ];

    public function question()
    {
        return $this->belongsTo(Quizz::class, 'question_id');
    }
}
