<?php

use App\Http\Controllers\Master\PartnerController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Partner'], function () {

    Route::get('/partner', [PartnerController::class, 'index'])
        ->name('mitra.index');

    Route::get('/partner/create', [PartnerController::class, 'create'])
        ->name('mitra.create');

    Route::post('/partner', [PartnerController::class, 'store'])
        ->name('mitra.store');

    Route::get('/partner/{id}', [PartnerController::class, 'show'])
        ->name('mitra.show');

    Route::get('/partner/{id}/edit', [PartnerController::class, 'edit'])
        ->name('mitra.edit');

    Route::put('/partner/{id}', [PartnerController::class, 'update'])
        ->name('mitra.update');

    Route::delete('/partner/{id}', [PartnerController::class, 'destroy'])
        ->name('mitra.destroy');
});
