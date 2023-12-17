@extends ('app.base')
@section('title', 'Create Quizz')
@section ('content')
@include('modal.deleteQuizz')


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
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center mb-4 animated-text2" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);">
                    Create your question
                </h1>
                <form action="{{ url('quizz') }}" method="POST" id="createQuestionForm">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" class="form-control" id="question" name="question" minlength="5" maxlength="300" required value="{{ old('question') }}" placeholder="Insert your question..." title="Insert your question">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Answers</label>
                                <input type="text" class="form-control mb-2" name="answers[]" minlength="1" maxlength="300" required placeholder="Answer 1">
                                <input type="text" class="form-control mb-2" name="answers[]" minlength="1" maxlength="300" required placeholder="Answer 2">
                                <input type="text" class="form-control mb-2" name="answers[]" minlength="1" maxlength="300" required placeholder="Answer 3">
                                <input type="text" class="form-control mb-2" name="answers[]" minlength="1" maxlength="300" required placeholder="Answer 4">
                            <div class="mb-3">
                                <label class="form-label">Select Correct Answer</label>
                                <div class="d-flex justify-content-between">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="correct_answer_0" name="correct_answer" value="0">
                                        <label for="correct_answer_0" class="form-check-label">Answer 1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="correct_answer_1" name="correct_answer" value="1">
                                        <label for="correct_answer_1" class="form-check-label">Answer 2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="correct_answer_2" name="correct_answer" value="2">
                                        <label for="correct_answer_2" class="form-check-label">Answer 3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="correct_answer_3" name="correct_answer" value="3">
                                        <label for="correct_answer_3" class="form-check-label">Answer 4</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <a href="{{ url('quizz') }}" class="btn btn-danger mx-3">Cancel</a>
                                <button class="btn btn-primary mx-3" type="submit">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="mb-3">
        <div class="card-body">
            <h2 class="text-center mb-4">Last 5 Questions Added to the database.</h2>
            @foreach($lastQuestions as $question)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $question->question }}</h5>
                        <p class="card-text">
                            @if($question->correctAnswer)
                                Correct Answer: {{ $question->correctAnswer->answer_text }}
                            @else
                                No correct answer available
                            @endif
                        </p>
                        <a href="{{ route('quizz.show', $question->id) }}" class="btn btn-primary">View Question</a>
                                    <button data-url="{{ url('quizz/' . $question->id) }}" href="{{route('quizz.create')}}" data-title="{{ $question->title }}" type="button" class="btn btn-danger mx-3" data-bs-toggle="modal" data-bs-target="#deleteQuizzModal">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteQuizzModal = document.getElementById('deleteQuizzModal');
        const quizzTitle = document.getElementById('quizzTitle');
        const formDeleteV3 = document.getElementById('formDeleteV3');

        deleteQuizzModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            quizzTitle.innerHTML = button.dataset.title;
            formDeleteV3.action = button.dataset.url;
        });
    });
</script>

@endsection
