<?php

namespace App\Routers;

use App\Http\Controllers\ContestController;
use Illuminate\Support\Facades\Route;

class ContestRouter
{
  public static function routes()
  {
    Route::prefix('contests')->group(function () {
      Route::get('/{contest}', [ContestController::class, 'show'])->name('contests.show');
      Route::get('/', [ContestController::class, 'index'])->name('contests.index');
      Route::get('/{contest}', [ContestController::class, 'show'])->name('contests.show');
    });
  }
}
