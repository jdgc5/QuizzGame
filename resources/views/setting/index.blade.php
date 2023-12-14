@extends ('app.base')
@section('title', 'Magical Proxy')

@section ('content')
    <form action="{{ url('setting') }}" method="POST">
        @method('put')
        @csrf

        <h6>Behavior after inserting new cards</h6>
        <br>

        <input type="radio" class="form-check-input" id="showCarta" name="afterInsert" value="show cartas" {{ $checkedList }}/>
        <label for="showCarta" class="form-check-label">Show all cards</label>
        <br>

        <input type="radio" class="form-check-input" id="createCarta" name="afterInsert" value="create carta" {{ $checkedCreate }}/>
        <label for="createCarta" class="form-check-label">Show create new card form</label>
        <br>
        <br>

        <h6 class="mb-4">Behaviour after edit a card</h6>
        
        <select name="afterEdit" id="afterEdit" class="form-select" aria-label="Default select example">
            <label for="afterEdit">Behavior after editing card</label>
            @foreach ($afterEditOptions as $value => $label)
                <option value="{{ $value }}" {{ $editOption == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>

        <br>
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
@endsection
