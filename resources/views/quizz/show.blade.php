@extends ('app.base')
@section('title', 'Quizz Game')

@section ('content')
@include('modal.deleteQuizz')


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
            <a href="{{ url('./quizz/viewQuestions') }}" class="btn btn-primary">Volver</a>
            <button data-url="{{ url('quizz/' . $quizz->id) }}" data-title="{{ $quizz->title }}" type="button" class="btn btn-danger mx-3" data-bs-toggle="modal" data-bs-target="#deleteQuizzModal">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
        </div>
    </div>
</div>

<!-- Tu HTML existente -->

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
