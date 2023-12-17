@extends('app.base')
@section('title', 'Edit Quizz')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4 animated-text2" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);">
                        Edit your question
                    </h5>
                    <form action="{{ route('quizz.update', $quizz->id) }}" method="POST" id="editQuestionForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" minlength="5" maxlength="300" required value="{{ $quizz->question }}" placeholder="Edit your question..." title="Edit your question">
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <label class="form-label">Answers</label>
                                </div>
                                <div>
                                    <label class="form-label pr-5">Correct</label>
                                </div>
                            </div>
                            @foreach($quizz->answers as $key => $answer)
                                <div class="card mb-2">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <input type="text" class="form-control w-95" name="answers[]" minlength="1" maxlength="300" required placeholder="Answer {{ $key + 1 }}" value="{{ $answer->answer_text }}">
                                        <div class="d-flex justify-content-center ml-1">
                                            <input type="radio" id="correct_answer_{{ $key }}" name="correct_answer" value="{{ $key }}" @if($answer->is_correct) checked @endif>
                                            <label for="correct_answer_{{ $key }}"></label>
                                        </div>
                                    </div>
                                @if($answer->is_correct)
                                    <span class="badge bg-success mb-1 col-md-6 mx-auto">Correct</span>
                                @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ url('./quizz/viewQuestions') }}" class="btn btn-danger mx-3">Cancel</a>
                            <button class="btn btn-primary mx-3" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



