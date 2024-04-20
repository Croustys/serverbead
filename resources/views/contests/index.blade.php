@extends('layouts.app')

@section('title', 'Meccsek')

@section('content')
<div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">Meccsek</h1>
    <ul class="list-disc pl-4">
        @foreach ($contests as $contest)
        <li class="mb-2">
            <a href="{{ route('contests.show', $contest) }}" class="text-blue-500 hover:underline">Visit</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection