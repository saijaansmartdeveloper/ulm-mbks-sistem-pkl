<?php

use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function() {
    Route::get('dashboard', [\App\Http\Controllers\LecturerController::class, 'index'])
        ->name('lecturer.index');
});
