@extends('layouts.app')

@section('title', 'Create Place')

@section('content')
<div class="max-w-md mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Place Creation</h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image upload:</label>
            <input type="file" id="image" name="image" value="{{ old('image') }}" class="mt-1 p-2 border rounded-md w-full" accept="image/*" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">Create</button>
    </form>
</div>
@endsection