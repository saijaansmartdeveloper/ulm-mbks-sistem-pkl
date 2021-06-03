<?php

use App\Http\Controllers\MonevController;
use Illuminate\Support\Facades\Route;

Route::prefix('monev')->group(function () {

    Route::get('laporan-monev', [MonevController::class, 'index'])
        ->name('laporan-monev.index');

    Route::get('laporan-monev/create', [MonevController::class, 'create'])
        ->name('laporan-monev.create');

    Route::get('laporan-monev/{id}', [MonevController::class, 'show'])
        ->name('laporan-monev.show');

    Route::post('laporan-monev', [MonevController::class, 'store'])
        ->name('laporan-monev.store');

    Route::delete('laporan-monev', [MonevController::class, 'destroy'])
        ->name('laporan-monev.destroy');

});
