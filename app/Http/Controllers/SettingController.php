<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
        public function index()
    {
        // parte superior con el radio button
        $checkedList = '';
        $checkedCreate = '';
        $afterInsert = session('afterInsert', 'show quizzs');
        if ($afterInsert == 'show quizzs') {
            $checkedList = 'checked';
        } else {
            $checkedCreate = 'checked';
        }
        
        // parte inferior con el select
        $afterEdit = session('afterEdit','edit');
        $afterEditOptions = [
            "quizz" => 'Show all quizzs list',
            "edit" => 'Show edit quizzs form',
            "show" => 'Show quizzs'
        ];

        return view('setting.index', [
            'checkedList' => $checkedList,
            'checkedCreate' => $checkedCreate,
            'afterEditOptions' => $afterEditOptions,
            'editOption' => $afterEdit
        ]);
    }
    
    public function update(Request $request)
    {
        session(['afterInsert' => $request->afterInsert, 'afterEdit' => $request->afterEdit]);

        return redirect('quizz')->with(['message' => 'Settings have been updated.']);
        return back()->with(['message' => 'Settings have been updated.']);
    }
}
