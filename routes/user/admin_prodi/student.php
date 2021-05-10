<?php

use App\Http\Controllers\Master\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Student'], function () {

    Route::get('/student', [StudentController::class, 'index'])
        ->name('mahasiswa.index');

    Route::get('/student/create', [StudentController::class, 'create'])
        ->name('mahasiswa.create');

    Route::post('/student', [StudentController::class, 'store'])
        ->name('mahasiswa.store');

    Route::get('/student/{id}', [StudentController::class, 'Show'])
        ->name('mahasiswa.show');

    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])
        ->name('mahasiswa.edit');

    Route::put('/student/{id}', [StudentController::class, 'update'])
        ->name('mahasiswa.update');

    Route::delete('/student/{id}', [StudentController::class, 'destroy'])
        ->name('mahasiswa.destroy');
});
