<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index()
    {
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
            'enemy' => 'nullable|boolean',
        ]);

        $totalPoints = $request->defence + $request->strength + $request->accuracy + $request->magic;
        if ($totalPoints > 20) {
            return redirect()->back()->withErrors(["total" => "Sum of ability points can't exceed 20!"])->withInput();
        }

        $user = Auth::user();

        $character = new Character();
        $character->name = $request->name;
        $character->defence = $request->defence;
        $character->strength = $request->strength;
        $character->accuracy = $request->accuracy;
        $character->magic = $request->magic;
        $character->user_id = $user->id;
        if ($user->admin) {
            $character->enemy = $request->enemy;
        }
        $character->save();

        return redirect()->route('characters.index')->with('success', 'Character created successfully.');
    }

    public function details($id)
    {
        $user = Auth::user();
        $character = Character::with('contests')->findOrFail($id);
        if ($user->id !== $character->user_id) {
            return redirect()->route('characters.index');
        }
        return view('characters.details', compact('character'));
    }

    public function edit(Character $character)
    {
        if ($character->user_id !== auth()->id() && !auth()->user()->admin) {
            $user = Auth::user();
            $characters = $user->characters;

            return redirect()->route('characters.index');
        }
        return view('characters.edit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        if ($character->user_id !== Auth::id() && !(Auth::user()->admin && $character->is_enemy)) {
            return redirect()->route('characters.index');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|integer|min:0',
            'strength' => 'required|integer|min:0',
            'accuracy' => 'required|integer|min:0',
            'magic' => 'required|integer|min:0',
        ]);

        $totalPoints = $request->defence + $request->strength + $request->accuracy + $request->magic;
        if ($totalPoints > 20) {
            return redirect()->back()->withErrors(["total" => "Sum of ability points can't exceed 20!"])->withInput();
        }

        $character->update([
            'name' => $request->name,
            'defence' => $request->defence,
            'strength' => $request->strength,
            'accuracy' => $request->accuracy,
            'magic' => $request->magic,
            'is_enemy' => $request->has('enemy') && Auth::user()->admin && $character->is_enemy,
        ]);

        return redirect()->route('characters.index')->with('success', 'Character updated successfully.');
    }

    public function destroy(Character $character)
    {
        if ($character->user_id !== auth()->id() && !auth()->user()->admin) {
            abort(403, 'Unauthorized action.');
        }

        $character->delete();

        return redirect()->route('characters.index')->with('success', 'Character deleted successfully.');
    }

    public function startMatch(Character $character)
    {
        $user = Auth::user();
        if ($user->id !== $character->user_id) {
            return redirect()->route('characters.index');
        }

        $place = Place::inRandomOrder()->first();

        $opponent = Character::where('id', '!=', $character->id)->where('enemy', true)->inRandomOrder()->first();

        $contest = new Contest();
        $contest->win = null;
        $contest->history = '';
        $contest->place()->associate($place);
        $contest->save();

        $contest->characters()->attach([$character->id, $opponent->id], [
            'hero_hp' => $character->strength + $character->magic,
            'enemy_hp' => $opponent->strength + $opponent->magic,
        ]);

        return redirect()->route('contests.show', $contest);
    }
}
