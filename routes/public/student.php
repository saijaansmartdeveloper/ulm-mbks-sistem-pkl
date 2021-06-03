<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {

    Route::get('dashboard', [StudentController::class, 'index'])
        ->name('student.index');

    Route::get('/{id}', [StudentController::class, 'show'])
        ->name('student.show');

    Route::get('/{id}/edit', [StudentController::class, 'edit'])
        ->name('student.edit');

    Route::put('/{id}/edit', [StudentController::class, 'update'])
        ->name('student.update');

});
