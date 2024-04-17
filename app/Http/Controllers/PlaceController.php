<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
  public function index()
  {
    $places = Place::all();
    return view('places.index', compact('places'));
  }
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
    ]);

    $imagePath = $request->file('image')->store('images/places');

    Place::create([
      'name' => $request->name,
      'image' => $imagePath,
    ]);

    return redirect()->route('places.create')->with('success', 'Helyszín sikeresen létrehozva!');
  }
}
