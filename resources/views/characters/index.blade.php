@extends('layouts.app')

@section('title', 'Your Characters')

@section('content')
<div class="p-6">
  <h1 class="text-3xl font-semibold mb-6">Your Characters</h1>
  <a href="/characters/create" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded-md">Create Character</a>

  <div class="overflow-x-auto">
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
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
          <td class="px-4 py-2 text-center">{{ $character->defence }}</td>
          <td class="px-4 py-2 text-center">{{ $character->strength }}</td>
          <td class="px-4 py-2 text-center">{{ $character->accuracy }}</td>
          <td class="px-4 py-2 text-center">{{ $character->magic }}</td>
          <td class="px-4 py-2 text-center">
            <a href="{{ route('characters.details', $character->id) }}" class="text-blue-500 hover:underline">Details</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @auth
  @if(auth()->user()->admin)
  <h1 class="mt-5 font-medium">Enemies</h1>
  <div class="overflow-x-auto">
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2">Defence</th>
          <th class="px-4 py-2">Strength</th>
          <th class="px-4 py-2">Accuracy</th>
          <th class="px-4 py-2">Magic</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($enemies as $character)
        <tr class="bg-gray-100 border-b border-gray-200">
          <td class="px-4 py-2">{{ $character->name }}</td>
          <td class="px-4 py-2 text-center">{{ $character->defence }}</td>
          <td class="px-4 py-2 text-center">{{ $character->strength }}</td>
          <td class="px-4 py-2 text-center">{{ $character->accuracy }}</td>
          <td class="px-4 py-2 text-center">{{ $character->magic }}</td>
          <td class="px-4 py-2 text-center">
            <a href="{{ route('characters.details', $character->id) }}" class="text-blue-500 hover:underline">Details</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
  @endauth
</div>
@endsection