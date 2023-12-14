@extends('app.base')

@section('title', 'ViewOptions')

@section('content')

@include('modal.deleteQuizz')

<div class="container mt-4">
    <h1 class="text-center mb-4 text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);">Welcome to Quizz The Game</h1>

    <div class="row">
        <div class="col-md-6 mb-4 mt-4">
            <div class="card">
              <div class="card-body text-center">
                  <h3 class="card-title mb-3 font-weight-bold">Create Questions</h3>
                  <p class="card-subtitle mb-3">You can create unique questions and answers for your Quizz Game</p>
                  <a href="{{ url('quizz/create') }}" class="btn btn-primary btn-lg">
                      Create
                  </a>
              </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 mt-4">
            <div class="card">
              <div class="card-body text-center">
                  <h3 class="card-title mb-3 font-weight-bold">Check Questions</h3>
                  <p class="card-subtitle mb-3">Read / Edit / Delete your Questions and Answers</p>
                  <a href="{{ url('quizz/viewQuestions') }}" class="btn btn-primary btn-lg">
                      Check
                  </a>
              </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 mt-4">
            <div class="card">
              <div class="card-body text-center">
                  <h3 class="card-title mb-3 font-weight-bold">Play Game</h3>
                  <p class="card-subtitle mb-3">Test your skills playing a Quizz Game</p>
                  <a href="{{ url('quizz/game') }}" class="btn btn-primary btn-lg">
                      Play
                  </a>
              </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 mt-4">
            <div class="card">
              <div class="card-body text-center">
                  <h3 class="card-title mb-3 font-weight-bold">History Games</h3>
                  <p class="card-subtitle mb-3">Want to see your Quizz Game History?</p>
                  <a href="{{ url('quizz/history') }}" class="btn btn-primary btn-lg">
                      Play
                  </a>
              </div>
            </div>
        </div>
    </div>
</div>

    <!-- Repite la estructura similar para las secciones 2 a 6 -->
</div>

@endsection

