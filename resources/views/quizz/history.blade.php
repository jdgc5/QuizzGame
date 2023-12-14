@extends('app.base')
@section('title', 'Game History')
@section('content')

<div class="container mt-4">
    <div class="mb-3">
        <div class="card-body">
            <h2 class="text-center mb-4">Game History</h2>
            @if(count($gameHistory) > 0)
                @foreach($gameHistory as $game)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Game ID: {{ $game->id }}</h5>
                            <p class="card-text">Score: {{ $game->score }}</p>
                            <p class="card-text">Played At: {{ $game->created_at }}</p>
                            <!-- Agrega más detalles según lo que hayas guardado -->
                        </div>
                    </div>
                @endforeach
            @else
                <p>No game history available</p>
            @endif
        </div>
    </div>
</div>
@endsection
