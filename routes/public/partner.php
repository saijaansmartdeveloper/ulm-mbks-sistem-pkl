<?php

use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;

Route::prefix('partner')->group(function () {

    Route::get('dashboard', [PartnerController::class, 'index'])
        ->name('partner.index');

    Route::get('guidance', [PartnerController::class, 'guidance'])
        ->name('partner.guidance');

});
