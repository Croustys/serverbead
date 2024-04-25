@extends('layouts.app')

@section('title', 'Contests')

@section('content')
<div class="container mx-auto mt-8 p-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($contests as $contest)
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Contest information</h2>
                <p class="text-sm text-gray-600 mb-2">Contest Location: {{ $contest->place ? $contest->place->name : 'Nincs megadva helyszín' }}</p>
                <p class="text-sm text-gray-600 mb-2">Contest starter: {{ $contest->user ? $contest->user->name : 'Nincs megadva felhasználó' }}</p>
                <p class="text-sm text-gray-600 mb-2">Participants:</p>
                <ul class="text-sm text-gray-600">
                    @foreach ($contest->characters as $character)
                    <li>{{ $character->name }} - <span class="{{ $character->enemy ? 'text-red-500' : 'text-green-500' }}">{{ $character->enemy ? 'Enemy' : 'Hero' }}</span></li>
                    @endforeach
                </ul>
                <a href="{{ route('contests.show', $contest) }}" class="text-blue-500 hover:underline mt-4 inline-block">Details</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection