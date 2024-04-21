<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Routers\CharacterRouter;
use App\Routers\ContestRouter;
use App\Routers\PlaceRouter;

Route::get('/', [HomeController::class, 'index']);

CharacterRouter::routes();
PlaceRouter::routes();
ContestRouter::routes();

Route::get('/dashboard', function () {
    return redirect('/characters');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/matches', 'MatchController@index')->name('matches.index');

require __DIR__ . '/auth.php';
