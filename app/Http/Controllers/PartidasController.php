<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;
use App\Models\Answer;
use App\Models\History;
use App\Http\Controllers\GameController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\PartidasController;

class PartidasController extends Controller
{
    public function index()
    {
        $partidas = History::get();
        return view('partidas.index', ['partidas' => $partidas]);
        
    }

    public function show($id)
    {
    
        try {
            $partida = History::findOrFail($id);
            
            return view('partidas.show', compact('partida'));
        } catch (\Exception $e) {
            return redirect()->route('partidas.index')->with('error', 'La partida no fue encontrada.');
        }
    }
    
    public function store(Request $request)
    {   
        $requestData = $request->all();
        
        $userAnswersJSON = $requestData['userAnswers'];
        
        $userAnswers = json_decode($userAnswersJSON, true);
        $score = $userAnswers['score'];
        $user = $request->session()->get('user');
        $tryAgain = $userAnswers['tryAgain'];
        History::create([
            'user_name' => $user->name,
            // 'answered_questions' => json_encode($answeredQuestions),
            'score' => $score,
            'played_at' => now(),
        ]);
        if($tryAgain){
            return redirect()->back()->with('message', 'Good luck in your new Game');
        }    
    
        return redirect()->route('quizz.index')->with('message', 'Game history saved successfully!');
    }

    
    public function destroy($id)
    {
        
        try {
            $partida = History::findOrFail($id);
           
            $partida->delete();
            return redirect('partidas/index')->with(['message' => 'This history game data has been deleted']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'This history game data has not been deleted']);
        }
    }

}
