<?php

use App\Http\Controllers\MonevController;
use Illuminate\Support\Facades\Route;

Route::prefix('monev')->group(function () {

    Route::get('laporan-monev', [MonevController::class, 'index'])
        ->name('laporan-monev.index');

});
