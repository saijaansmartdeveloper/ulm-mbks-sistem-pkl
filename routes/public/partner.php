<?php

use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;

Route::prefix('partner')->group(function () {

    Route::get('dashboard', [PartnerController::class, 'index'])
        ->name('partner.index');

    Route::get('/{id}', [PartnerController::class, 'show'])
        ->name('partner.show');

    Route::get('/{id}/edit', [PartnerController::class, 'edit'])
        ->name('partner.edit');

    Route::put('/{id}/edit', [PartnerController::class, 'update'])
        ->name('partner.update');

    Route::get('guidance', [PartnerController::class, 'guidance'])
        ->name('partner.guidance');

});
