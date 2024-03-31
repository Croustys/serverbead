<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Character;
use App\Models\MatchModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $characterCount = Character::count();

        $matchCount = MatchModel::count();

        return view('home', compact('characterCount', 'matchCount'));
    }
}
