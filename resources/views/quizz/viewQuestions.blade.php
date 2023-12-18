@extends('app.base')

@section('title', 'viewQuestions')

@section('content')

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


@foreach($quizzs as $quizz)


<div class="col-lg-10 mb-4 mx-auto">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $quizz->question }}</h5>
            <ul class="list-group">
                @foreach($quizz->answers as $answer)
                <li class="list-group-item d-flex justify-content-between align-items-center @if($answer->is_correct) list-group-item-success @endif">
                    {{ $answer->answer_text }}
                    @if($answer->is_correct)
                    <p></p>
                    <span class="badge bg-success">Correcta</span>
                    @endif
                </li>
                @endforeach
            </ul>
            <div class="text-center mt-3">
                <a class="btn btn-primary me-2" href="{{ url('quizz/' . $quizz->id) }}"><i class="fa-regular fa-eye"></i> Ver</a>
                <a class="btn btn-warning me-2" href="{{ url('quizz/' . $quizz->id . '/edit') }}"><i class="fa-solid fa-pen"></i> Editar</a>
                <button data-url="{{ url('quizz/' . $quizz->id) }}" data-title="{{ $quizz->title }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteQuizzModal">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach



<script>
  const deleteQuizzModal = document.getElementById('deleteQuizzModal');
  const quizzTitle = document.getElementById('quizzTitle');
  const formDeleteV3 = document.getElementById('formDeleteV3');
  deleteQuizzModal.addEventListener('show.bs.modal', event => {
  quizzTitle.innerHTML = event.relatedTarget.dataset.title;
  formDeleteV3.action = event.relatedTarget.dataset.url;
  });
</script>
@endsection