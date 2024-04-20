@extends('layouts.app')

@section('title', 'Karakterek')

@section('content')
<div class="p-6">
  <h1 class="text-3xl font-semibold mb-6">Karaktereid</h1>
  <a href="/characters/create" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded-md">Új karakter</a>

  <div class="overflow-x-auto">
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Defence</th>
          <th class="px-4 py-2">Strength</th>
          <th class="px-4 py-2">Accuracy</th>
          <th class="px-4 py-2">Magic</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($characters as $character)
        <tr class="bg-gray-100 border-b border-gray-200">
          <td class="px-4 py-2">{{ $character->name }}</td>
          <td class="px-4 py-2">{{ $character->defence }}</td>
          <td class="px-4 py-2">{{ $character->strength }}</td>
          <td class="px-4 py-2">{{ $character->accuracy }}</td>
          <td class="px-4 py-2">{{ $character->magic }}</td>
          <td class="px-4 py-2">
            <a href="{{ route('characters.details', $character->id) }}" class="text-blue-500 hover:underline">Details</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection