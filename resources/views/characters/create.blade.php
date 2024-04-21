@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">Create New Character</h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('characters.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <div>
            <label for="defence" class="block">Defence:</label>
            <input type="number" id="defence" name="defence" value="{{ old('defence') }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <div>
            <label for="strength" class="block">Strength:</label>
            <input type="number" id="strength" name="strength" value="{{ old('strength') }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <div>
            <label for="accuracy" class="block">Accuracy:</label>
            <input type="number" id="accuracy" name="accuracy" value="{{ old('accuracy') }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <div>
            <label for="magic" class="block">Magic:</label>
            <input type="number" id="magic" name="magic" value="{{ old('magic') }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        @if(Auth::user()->admin)
        <div class="flex items-center">
            <input type="checkbox" id="enemy" name="enemy" value="1" {{ old('enemy') ? 'checked' : '' }} class="mr-2">
            <label for="enemy">Enemy</label>
        </div>
        @endif

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Create Character</button>
    </form>
</div>
@endsection