<?php

namespace App\Http\Controllers;

use App\Models\Quizz;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Answer;
use App\Http\Controllers\GameController;
use App\Http\Controllers\QuizzController;

class GameController extends Controller
{
    public function getRandomQuestion()
    {
        $randomQuestion = Quizz::inRandomOrder()->first();

        return response()->json([
            'question' => $randomQuestion->question_text,
            'answers' => [
                $randomQuestion->answer_1,
                $randomQuestion->answer_2,
                $randomQuestion->answer_3,
                $randomQuestion->answer_4,
            ]
        ]);
    }
}
