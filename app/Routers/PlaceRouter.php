<?php

namespace App\Routers;

use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

class PlaceRouter
{
  public static function routes()
  {
    Route::prefix('places')->middleware([AdminMiddleware::class])->group(function () {
      Route::get('/', [PlaceController::class, 'index'])->name('places.index');
      Route::get('/create', [PlaceController::class, 'create'])->name('places.create');
      Route::post('/', [PlaceController::class, 'store'])->name('places.store');
      Route::delete('/{place}', [PlaceController::class, 'destroy'])->name('places.destroy');
      Route::get('/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit');
      Route::put('/{place}', [PlaceController::class, 'update'])->name('places.update');
    });
  }
}
