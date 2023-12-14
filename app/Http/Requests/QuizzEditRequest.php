<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizzEditRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string|min:5|max:300|unique:quizz,question'. $this->quizz->id,
            'answers' => 'required|array|min:4|max:4', 
            'answers.*' => 'required|string|min:1|max:300', 
            'correct_answer' => 'required|numeric|in:0,1,2,3' 
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'El campo pregunta es obligatorio.',
            'question.string' => 'La pregunta debe ser un texto.',
            'question.min' => 'La pregunta debe tener al menos :min caracteres.',
            'question.max' => 'La pregunta no puede tener más de :max caracteres.',
            'question.unique' => 'La pregunta ya existe en la base de datos.',

            'answers.required' => 'Debes proporcionar las respuestas.',
            'answers.array' => 'Las respuestas deben ser un conjunto de valores.',
            'answers.min' => 'Debes proporcionar al menos :min respuestas.',
            'answers.max' => 'Solo se permiten :max respuestas.',

            'answers.*.required' => 'Cada respuesta es obligatoria.',
            'answers.*.string' => 'Cada respuesta debe ser un texto.',
            'answers.*.min' => 'Cada respuesta debe tener al menos :min caracteres.',
            'answers.*.max' => 'Cada respuesta no puede tener más de :max caracteres.',

            'correct_answer.required' => 'Debes seleccionar la respuesta correcta.',
            'correct_answer.numeric' => 'La respuesta correcta debe ser un número.',
            'correct_answer.in' => 'La respuesta correcta debe estar entre 0 y 3.'
        ];
    }
}



