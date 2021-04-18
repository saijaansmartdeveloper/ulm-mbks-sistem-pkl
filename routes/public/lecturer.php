<?php

use App\Http\Controllers\LecturerController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function() {
    Route::get('dashboard', [LecturerController::class, 'index'])
        ->name('lecturer.index');
});
