@extends('layouts.app')

@section('title', 'Contest Details')

@section('content')
<div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">Contest Details</h1>

    @if($contest->place)
    <p class="mb-4"><strong>Location:</strong> {{ $contest->place->name }}</p>
    @else
    <p class="mb-4">No location specified for this contest.</p>
    @endif

    <h2 class="text-lg font-semibold mb-2">Participants:</h2>
    <ul>
        @foreach($contest->characters as $character)
        <li class="mb-2">{{ $character->name }}</li>
        @endforeach
    </ul>
</div>
@endsection