@extends('layouts.app')

@section('content')
<h1>Create New Character</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('characters.store') }}">
    @csrf

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="defence">Defence:</label>
        <input type="number" id="defence" name="defence" value="{{ old('defence') }}" required>
    </div>

    <div>
        <label for="strength">Strength:</label>
        <input type="number" id="strength" name="strength" value="{{ old('strength') }}" required>
    </div>

    <div>
        <label for="accuracy">Accuracy:</label>
        <input type="number" id="accuracy" name="accuracy" value="{{ old('accuracy') }}" required>
    </div>

    <div>
        <label for="magic">Magic:</label>
        <input type="number" id="magic" name="magic" value="{{ old('magic') }}" required>
    </div>

    @if(Auth::user()->admin)
    <div>
        <label for="enemy">Enemy:</label>
        <input type="checkbox" id="enemy" name="enemy" value="1">
    </div>
    @endif

    <button type="submit">Create Character</button>
</form>

@endsection