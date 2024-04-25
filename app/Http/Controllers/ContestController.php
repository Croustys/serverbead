<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;


class ContestController extends Controller
{
  public function index()
  {
    $contests = Contest::all();
    return view('contests.index', compact('contests'));
  }

  public function create(Character $character)
  {
    $user = Auth::user();
    if ($user->id !== $character->user_id || $character->enemy) {
      return redirect()->back()->withErrors(["enemy" => "You cannot start a contest with an enemy!"])->withInput();
    }
    $locations = Place::pluck('id')->toArray();

    $enemy = Character::where('id', '!=', $character->id)->where('enemy', true)->inRandomOrder()->first();

    $location = $locations[array_rand($locations)];

    $match = new Contest();
    $match->place_id = $location;
    $match->user_id = auth()->id();
    $match->save();

    $match->characters()->attach([$character->id, $enemy->id]);

    return redirect()->route('contests.show', $match->id);
  }
  public function show(Contest $contest)
  {
    $contest->load('characters', 'place');

    return view('contests.show', compact('contest'));
  }
}
