<?php

namespace App\Routers;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;
use Illuminate\Support\Facades\Route;

class CharacterRouter
{
  public static function routes()
  {
    Route::prefix('characters')->group(function () {
      Route::get('/', [CharacterController::class, 'index'])->middleware(['auth', 'verified'])->name('characters.index');
      Route::post('/', [CharacterController::class, 'store'])->middleware(['auth', 'verified'])->name('characters.store');
      Route::get('/create', [CharacterController::class, 'create'])->middleware(['auth', 'verified'])->name('characters.create');
      Route::get('/{character}/edit', [CharacterController::class, 'edit'])->middleware(['auth', 'verified'])->name('characters.edit');
      Route::get('/{id}', [CharacterController::class, 'details'])->middleware(['auth', 'verified'])->name('characters.details');
      Route::put('/{character}', [CharacterController::class, 'update'])->middleware(['auth', 'verified'])->name('characters.update');
      Route::delete('/{character}', [CharacterController::class, 'destroy'])->middleware(['auth', 'verified'])->name('characters.destroy');
      Route::post('/{character}/matches', [ContestController::class, 'create'])->middleware(['auth', 'verified'])->name('matches.create');
      Route::post('/{character}/start-match', [CharacterController::class, 'startMatch'])->middleware(['auth', 'verified'])->name('characters.start-match');
    });
  }
}
