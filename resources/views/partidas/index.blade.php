@extends('app.base')

@section('title', 'Historial de Partidas')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-10 mb-4 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Partida Jugada</th>
                            <th>Número Aciertos</th>
                            <th>Usuario de la Partida</th>
                            <th>Fecha y Hora</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí iterarás sobre las partidas jugadas -->
                        @foreach($partidas as $partida)
                            <tr>
                                <td>{{ $partida->id }}</td>
                                <td>{{ $partida->aciertos }}</td>
                                <td>{{ $partida->usuario }}</td>
                                <td>{{ $partida->fecha }}</td>
                                <td>
                                    <form action="{{ route('partidas.destroy', $partida->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                    </form>
                                    <a href="{{ route('partidas.show', $partida->id) }}" class="btn btn-primary">Ver Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
