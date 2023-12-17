<?php

namespace App\Http\Controllers;

use App\Models\Quizz;
use App\Models\Answer;
use App\Models\History;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\GameController;

use App\Http\Requests\QuizzCreateRequest;
use App\Http\Requests\QuizzEditRequest;



class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
    $user = $request->session()->get('user');
    return view('quizz.index', ['user' => $user]);
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $lastCorrectAnswers = Answer::where('is_correct', true)->with('quizz') ->latest()->take(5)->get();
        $lastQuestions = Quizz::with('correctAnswer')->latest()->take(5)->get();
        return view('quizz.create', compact('lastCorrectAnswers', 'lastQuestions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizzCreateRequest $request)
    {
    try {
        
        $question = Quizz::create([
            'question' => $request->question,
        ]);

        $answers = $request->answers; 
        $correctAnswerIndex = $request->correct_answer;
        
        foreach ($answers as $key => $value) {
            $isCorrect = $key == $correctAnswerIndex;
        
            $answer = new Answer([
                'answer_text' => $value,
                'is_correct' => $isCorrect,
            ]);
        
            $question->answers()->save($answer);
        }

        $afterInsert = session('afterInsert', 'show quizzs');
        $target = 'quizz';

        if ($afterInsert !== 'show quizzs') {
            $target = 'quizz/create';
        }

        return redirect($target)->with('message', 'Question has been created successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('message', 'Error creating this question: ' . $e->getMessage());
    }
    }
    /**
     * Display the specified resource.
     */
    public function show(Quizz $quizz)
    {
        
        return view('quizz.show',['quizz'=> $quizz]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quizz $quizz)
    {
        return view('quizz.edit',['quizz'=> $quizz]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quizz $quizz)
    {
    try {
        $quizz->question = $request->input('question');
        $quizz->save();

        $answers = $request->input('answers', []);
        $correctAnswerIndex = (int)$request->input('correct_answer', -1);

        foreach ($quizz->answers as $key => $answer) {
            if (isset($answers[$key])) {
                $answer->answer_text = $answers[$key];
                $answer->is_correct = ($key === $correctAnswerIndex);
                $answer->save();
            }
        }

        return redirect()->route('quizz.show', $quizz->id)->with('message', $quizz->name . ' has been updated');
    } catch (\Exception $e) {
        \Log::error($e);
        return back()->withInput()->withErrors(['message' => 'This question has not been updated.']);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quizz $quizz)
    {
        try {
            $quizz->delete();
            return redirect('quizz/viewQuestions')->with(['message' => 'This question has been deleted']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'This question has not been deleted']);
        }
    }
    
    function view(Request $request, $id)
    {
        $quizz = Quizz::find($id);
        if ($quizz == null){
            return abort(404);
        }
    }


    public function viewQuestions(Request $request){
        $quizzs = Quizz::with('correctAnswer')->get(); 
        return view('quizz.viewQuestions', ['quizzs' => $quizzs]);
    }
    
    
    private function processAndSaveImage($image)
    {
        $img = Image::make($image);
        $img->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio(); 
            $constraint->upsize();
        });
        $imagePath = 'quizz_images/' . uniqid('image_') . '.' . $image->getClientOriginalExtension();
        Storage::disk('quizz_images')->put($imagePath, (string) $img->encode());
        return $imagePath;
    }
    
    public function game(Request $request)
    {
    $user = $request->session()->get('user');
    $randomQuestions = Quizz::inRandomOrder()->take(5)->get();

    $formattedQuestions = $randomQuestions->map(function ($question) {
        $answers = $question->answers->map(function ($answer) {
            return [
                'answer_text' => $answer->answer_text,
                'is_correct' => $answer->is_correct,
            ];
        })->toArray();

        return [
            'question' => $question->question,
            'answers' => $answers,
        ];
    });

    return view('quizz.game', ['questions' => $formattedQuestions]);
    }

    public function finishGame($gameData) {
        $history = new History();
        $history->user_id = 1; // Cambiar esto por la ID del usuario actual
        $history->question_id = $gameData['question_id'];
        $history->answered_correctly = $gameData['answered_correctly'];
        $history->save();
    }
    
    public function showProfile()
{
    if (Auth::check()) {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('user.profile', compact('user'));
    }

    return redirect()->route('login'); // Redirigir a la página de inicio de sesión si el usuario no está autenticado
}
    


    
        
}