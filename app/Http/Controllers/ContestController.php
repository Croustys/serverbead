<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
use Illuminate\Support\Facades\Redirect;

class ContestController extends Controller
{
  public function index()
  {
    $contests = Contest::all();
    return view('contests.index', compact('contests'));
  }

  public function create(Character $character)
  {
    $locations = Place::pluck('id')->toArray();

    $enemies = Character::where('id', '!=', $character->id)->get();

    $location = $locations[array_rand($locations)];
    $enemy = $enemies->random();

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
