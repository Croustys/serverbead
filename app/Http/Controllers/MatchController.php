<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchModel;
use App\Models\Character;
use Illuminate\Support\Facades\Redirect;

class MatchController extends Controller
{
  public function create(Character $character)
  {
    // Véletlenszerűen válasszuk ki a helyszínt és az ellenfelet
    $locations = ['Arena', 'Forest', 'Mountains', 'Cave'];
    $enemies = Character::where('id', '!=', $character->id)->get();

    $location = $locations[array_rand($locations)];
    $enemy = $enemies->random();

    $match = new MatchModel();
    $match->place_id = $location; // Helyszín hozzárendelése
    $match->user_id = auth()->id(); // Hozzárendeljük a bejelentkezett felhasználót a mérkőzéshez
    $match->save();

    // Hozzárendeljük a karaktereket a mérkőzéshez
    $match->characters()->attach([$character->id, $enemy->id]);

    // Átirányítás a mérkőzés részletező oldalára
    return Redirect::route('matches.show', $match->id);
  }
}
