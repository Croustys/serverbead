<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = Auth::user();
        $characters = $user->characters;

        return view('characters.index', compact('characters'));
    }

    public function create()
    {
        return view('characters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|integer|min:0',
            'strength' => 'required|integer|min:0',
            'accuracy' => 'required|integer|min:0',
            'magic' => 'required|integer|min:0',
        ]);

        $totalPoints = $request->defence + $request->strength + $request->accuracy + $request->magic;
        if ($totalPoints !== 20) {
            return back()->with('error', 'The total attribute points must be equal to 20.');
        }

        $user = Auth::user();

        $character = new Character();
        $character->name = $request->name;
        $character->defence = $request->defence;
        $character->strength = $request->strength;
        $character->accuracy = $request->accuracy;
        $character->magic = $request->magic;
        $character->user_id = $user->id;
        $character->save();

        return redirect()->route('characters.index')->with('success', 'Character created successfully.');
    }

    public function details($id)
    {
        $character = Character::findOrFail($id);
        return view('characters.details', compact('character'));
    }
}
