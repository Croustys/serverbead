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
  public function create()
  {
    return view('places.create');
  }
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = $request->file('image')->store('images/places');

    Place::create([
      'name' => $request->name,
      'image' => $imagePath,
    ]);

    return redirect()->route('places.create')->with('success', 'Helyszín sikeresen létrehozva!');
  }

  public function destroy(Place $place)
  {
    if (!auth()->user()->admin) {
      abort(403, 'Unauthorized action.');
    }

    $place->delete();

    return redirect()->route('places.index')->with('success', 'Place deleted successfully.');
  }

  public function edit(Place $place)
  {
    return view('places.edit', compact('place'));
  }

  public function update(Request $request, Place $place)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $place->name = $request->name;

    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('places');
      $place->image = $imagePath;
    }

    $place->save();

    return redirect()->route('places.index')->with('success', 'Helyszín frissítve.');
  }
}
