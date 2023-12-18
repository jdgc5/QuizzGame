@extends ('app.base')
@section('title', 'Welcome')
@section('content')

@php
    $exclude = true;
@endphp

<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div style="position: relative; width: 100%;">
                <img class="img-fluid d-block mx-auto" src="{{ url('/assets/img/welcome7.png')}}" alt="Imagen de tu quizz" style="width: 50%; height: auto;">
                <a href="{{ route('quizz.index') }}" class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x">Start</a>
            </div>
        </div>
    </div>
</div>

@endsection
