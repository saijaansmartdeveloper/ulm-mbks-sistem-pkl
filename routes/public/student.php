<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function() {
    Route::get('dashboard', [StudentController::class, 'index'])
        ->name('student.index');
});
