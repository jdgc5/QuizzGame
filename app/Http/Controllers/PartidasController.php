<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;
use App\Models\Answer;
use App\Models\History;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PartidasController;

class PartidasController extends Controller
{
    public function index()
    {
        return view('partidas.index');
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
    
    public function destroy($id)
    {
        try {
            $partida = History::findOrFail($id);
        
            $partida->delete();
        
            return redirect()->route('partidas.index')->with('success', 'La partida fue eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('partidas.index')->with('error', 'No se pudo eliminar la partida.');
        }
        
    }

}
