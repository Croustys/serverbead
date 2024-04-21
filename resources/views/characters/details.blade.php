@extends('layouts.app')

@section('title', 'Karakter Adatok')

@section('content')
<div class="container mx-auto mt-8 p-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Karakter Adatok</h2>
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
                <h3 class="text-lg font-semibold mb-2">Mérkőzések</h3>
                <div class="divide-y divide-gray-200">
                    @if($character->contests->isNotEmpty())
                    @foreach($character->contests as $contest)
                    <div class="py-4">
                        <p class="text-sm text-gray-600 mb-2">{{ $contest->place->name }}</p>
                        <div class="flex items-center space-x-2">
                            @foreach($contest->characters as $char)
                            <div class="flex-1">
                                <p class="text-sm text-gray-600">
                                    @if($contest->win)
                                    <span class="text-green-500">Győztes: </span>
                                    @endif
                                    @if($char->id == $character->id)
                                    <span class="text-green-500">Hős: </span>
                                    @else
                                    <span class="text-red-500">Ellenség: </span>
                                    @endif
                                    {{ $char->name }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>Nincsenek mérkőzések ehhez a karakterhez.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection