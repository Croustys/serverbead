@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
  <h1 class="text-3xl font-semibold mb-6">Places List</h1>
  <a href="{{ route('places.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md mb-4">Új Helyszín létrehozása</a>

  <div class="overflow-x-auto">
    <table class="w-full border-collapse">
      <thead>
        <tr>
          <th class="px-4 py-2 border">Name</th>
          <th class="px-4 py-2 border">Image</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($places as $place)
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2 border">{{ $place->name }}</td>
          <td class="px-4 py-2 border">
            <img src="{{ $place->image }}" alt="Place Image" class="h-16">
          </td>
          <td class="px-4 py-2 border">
            <form method="POST" action="{{ route('places.destroy', $place->id) }}" onsubmit="return confirm('Are you sure you want to delete this place?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300 mt-4">Helyszín törlése</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection