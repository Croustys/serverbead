<?php

namespace App\Routers;

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

class CharacterRouter
{
  public static function routes()
  {
    Route::prefix('characters')->group(function () {
      Route::get('/', [CharacterController::class, 'index'])->name('characters.index');
      Route::get('/create', [CharacterController::class, 'create'])->name('characters.create');
      Route::post('/', [CharacterController::class, 'store'])->name('characters.store');
      Route::get('/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
      Route::get('/{id}', [CharacterController::class, 'details'])->name('characters.details');
      Route::put('/{character}', [CharacterController::class, 'update'])->name('characters.update');
      Route::delete('/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy');
    });
  }
}
