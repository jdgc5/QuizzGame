@extends ('app.base')
@section('title', 'Quizz Game')

@section ('content')


<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">{{ $quizz->question }}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($quizz->answers as $answer)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $answer->answer_text }}
                                @if($answer->is_correct)
                                    <span class="badge bg-success">Correcta</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-center">
            <a href="{{ url('./quizz/viewQuestions') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>

@endsection
