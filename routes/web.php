<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PlaceController;
use App\Routers\CharacterRouter;

Route::get('/', [HomeController::class, 'index']);

CharacterRouter::routes();

Route::post('/characters/{character}/start-match', [CharacterController::class, 'startMatch'])->name('characters.start-match');
Route::get('/contests/{contest}', [ContestController::class, 'show'])->name('contests.show');
Route::get('/contests', [ContestController::class, 'index'])->name('contests.index');
Route::get('/contests/{contest}', [ContestController::class, 'show'])->name('contests.show');

Route::get('/dashboard', function () {
    return redirect('/characters');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/create', [PlaceController::class, 'store'])->name('places.create');

Route::get('/matches', 'MatchController@index')->name('matches.index');

require __DIR__ . '/auth.php';
