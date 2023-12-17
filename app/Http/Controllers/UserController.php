<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quizz;
use App\Models\Answer;
use App\Models\History;
use App\Models\User;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function index()
    {
        
        return view('user.index');
    }
    
    public function create(){
        
        return view('user.create');
    }

    public function show($id)
    {
        // Lógica para mostrar un usuario específico
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        
        $user = new User();
        $user->name = $validatedData['name'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();
        return redirect()->route('user.index')->with('success', 'User created successfully!');
        
        
    
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
    
    public function processLogin(Request $request) {
    
    try {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user', $user);
            return redirect()->intended('quizz');
        }

            return redirect()->back()->withInput()->withErrors(['message' => 'User/Password Incorrect']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Error al iniciar sesión: ' . $e->getMessage()]);
        }
    }

}
