@extends('app.base')

@section('title', 'Historial de Partidas')

@section('content')

@include('modal.deleteQuizz')
    <div class="container mt-4">
        <div class="row">
            @foreach($partidas as $partida)
            <div class="col-lg-10 mb-4 mx-auto">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title">User: {{ $partida->user_name }}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold">Score:</h5>
                            <span class="badge ms-2 bg-primary">{{ $partida->score }}/5</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold">Date:</h5>
                            <span class="ms-2">{{ $partida->played_at }}</span>
                        </div>
                    </div>
                        <button data-url="{{ url('partidas/' . $partida->id) }}" data-title="{{ $partida->id }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteQuizzModal">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


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