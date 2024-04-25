@extends('layouts.app')

@section('title', 'Character Details')

@section('content')
<div class="container mx-auto mt-8 p-10 flex justify-evenly">
    <div class="bg-white rounded-lg shadow-md max-w-fit">
        <div class="p-6">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Character Details</h2>
                <p><a href="{{ route('characters.edit', $character->id) }}" class="text-black hover:underline"><i class="fa fa-pencil" style="font-size:24px"></i></a></p>
            </div>
            <div class="mb-4">
                <table class="table-auto w-full mb-4 border-collapse border border-gray-300">
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><strong>Name:</strong></td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $character->name }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><strong>Defence:</strong></td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $character->defence }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><strong>Strength:</strong></td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $character->strength }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><strong>Accuracy:</strong></td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $character->accuracy }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><strong>Magic:</strong></td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $character->magic }}</td>
                    </tr>
                </table>

            </div>
            <div class="flex justify-between">

                <form method="POST" action="{{ route('matches.create', $character->id) }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">New Contest</button>
                </form>

                <form method="POST" action="{{ route('characters.destroy', $character->id) }}" onsubmit="return confirm('Are you sure you want to delete this character?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300">Delete</button>
                </form>
            </div>

        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md max-w-fit p-6">
        <h3 class="text-lg font-semibold mb-4">Contests</h3>
        <div class="divide-y divide-gray-200">
            @if($character->contests->isNotEmpty())
            @foreach($character->contests as $contest)
            <a href="{{ route('contests.show', $contest) }}" class="block cursor-pointer hover:bg-gray-100 transition duration-200">
                <div class="p-4">
                    @if($contest->place)
                    <p class="text-sm text-gray-600 mb-2">{{ $contest->place->name }}</p>
                    @else
                    <p class="text-sm text-gray-600 mb-2">Place has been deleted.</p>
                    @endif
                    <div class="flex items-center space-x-2">
                        @foreach($contest->characters as $char)
                        <div>
                            <p class="text-sm text-gray-600">
                                @if($contest->win)
                                <span class="text-green-500">Winner: </span>
                                @endif
                                @if($char->id == $character->id)
                                <span class="text-green-500">Hero: </span>
                                @else
                                <span class="text-red-500">Enemy: </span>
                                @endif
                                {{ $char->name }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </a>
            @endforeach
            @else
            <p class="py-4 text-sm text-gray-600">There are no contests for this character.</p>
            @endif
        </div>
    </div>
</div>
@endsection