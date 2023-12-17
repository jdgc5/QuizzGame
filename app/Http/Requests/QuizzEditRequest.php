<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizzEditRequest extends QuizzCreateRequest
{

    public function rules(){
        
        $rules = parent::rules();
        $rules['question'] = 'required|string|min:5|max:300|unique:quizz,question'. $this->quizz->id;
        return $rules;
    }
}
