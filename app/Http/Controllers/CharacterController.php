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
        ]);

        $totalPoints = $request->defence + $request->strength + $request->accuracy + $request->magic;
        if ($totalPoints > 20) {
            return redirect()->back()->withErrors(["totalPoints" => "Nem lehet összesen 20nál több képességpontod!"])->withInput();
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
        $character = Character::with('contests')->findOrFail($id);
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
            abort(403, 'Unauthorized action.');
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
            return redirect()->back()->withErrors(["total" => "Nem lehet összesen 20nál több képességpontod!"])->withInput();
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
        // Véletlenszerűen válasszunk helyszínt
        $place = Place::inRandomOrder()->first();

        // Véletlenszerűen válasszunk ellenfelet
        $opponent = Character::where('id', '!=', $character->id)->inRandomOrder()->first();

        // Mérkőzés létrehozása
        $contest = new Contest();
        $contest->win = null; // Még nincs győztes
        $contest->history = ''; // Kezdetben üres a történet
        $contest->place()->associate($place);
        $contest->save();

        // A karakterek hozzáadása a mérkőzéshez
        $contest->characters()->attach([$character->id, $opponent->id], [
            'hero_hp' => $character->strength + $character->magic,
            'enemy_hp' => $opponent->strength + $opponent->magic,
        ]);

        // Felhasználó átirányítása a mérkőzés oldalára
        return redirect()->route('contests.show', $contest);
    }
}
