@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-8">
  <h1 class="text-3xl font-bold mb-4">Helyszín adatainak módosítása</h1>
  <form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label for="name" class="block text-sm font-medium text-gray-700">Helyszín neve:</label>
      <input type="text" id="name" name="name" value="{{ $place->name }}" class="mt-1 p-2 border rounded-md w-full" required>
    </div>
    <div class="mb-4">
      <label for="image" class="block text-sm font-medium text-gray-700">Kép feltöltése:</label>
      <input type="file" id="image" name="image" class="mt-1 p-2 border rounded-md w-full" accept="image/*">
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">Mentés</button>
  </form>
</div>
@endsection