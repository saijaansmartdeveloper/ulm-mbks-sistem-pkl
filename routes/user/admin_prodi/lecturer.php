<?php

use App\Http\Controllers\Master\LecturerController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'lecturer'], function () {

    Route::get('/lecturer', [LecturerController::class, 'index'])
        ->name('dosen.index');
    Route::get('/lecturer/create', [LecturerController::class, 'create'])
        ->name('dosen.create');
    Route::post('/lecturer', [LecturerController::class, 'store'])
        ->name('dosen.store');
    Route::get('/lecturer/{id}/edit', [LecturerController::class, 'edit'])
        ->name('dosen.edit');
    Route::put('/lecturer/{id}', [LecturerController::class, 'update'])
        ->name('dosen.update');
    Route::get('/lecturer/{id}', [LecturerController::class, 'show'])
        ->name('dosen.show');
    Route::delete('/lecturer/{id}', [LecturerController::class, 'destroy'])
        ->name('dosen.destroy');
});
