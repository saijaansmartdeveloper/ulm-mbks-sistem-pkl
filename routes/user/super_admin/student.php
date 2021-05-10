<?php

use App\Http\Controllers\Master\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Student'], function () {

    Route::get('/student', [StudentController::class, 'index_superadmin'])
        ->name('mahasiswa.superadmin.index');

    // Route::get('/student/{id}', [StudentController::class, 'Show'])
    //     ->name('mahasiswa.superadmin.show');

    // Route::get('/student/{id}/edit', [StudentController::class, 'edit'])
    //     ->name('mahasiswa.superadmin.edit');

    // Route::put('/student/{id}', [StudentController::class, 'update'])
    //     ->name('mahasiswa.superadmin.update');

    // Route::delete('/student/{id}', [StudentController::class, 'destroy'])
    //     ->name('mahasiswa.superadmin.destroy');
});
