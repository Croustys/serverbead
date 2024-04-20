@extends('layouts.app')

@section('title', 'Karakter Adatok')

@section('content')
<div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">Karakter Adatok</h1>
    <div class="mb-4">
        <p><strong>Name:</strong> {{ $character->name }}</p>
        <p><strong>Defence:</strong> {{ $character->defence }}</p>
        <p><strong>Strength:</strong> {{ $character->strength }}</p>
        <p><strong>Accuracy:</strong> {{ $character->accuracy }}</p>
        <p><strong>Magic:</strong> {{ $character->magic }}</p>
    </div>
    <form method="POST" action="{{ route('matches.create', $character->id) }}">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Új meccs</button>
    </form>
    <p class="mt-4"><a href="{{ route('characters.index') }}" class="text-blue-500 hover:underline">Vissza a karaktereimhez</a></p>
    <p><a href="{{ route('characters.edit', $character->id) }}" class="text-blue-500 hover:underline">Módosítás</a></p>
    <form method="POST" action="{{ route('characters.destroy', $character->id) }}" onsubmit="return confirm('Are you sure you want to delete this character?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300 mt-4">Karakter törlése</button>
    </form>
</div>
@endsection