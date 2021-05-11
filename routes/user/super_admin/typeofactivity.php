<?php

use App\Http\Controllers\Master\TypeOfActivityController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Acitivity'], function () {

    Route::get('/typeofactivity', [TypeOfActivityController::class, 'index'])
        ->name('jenis_kegiatan.index');

    Route::get('/typeofactivity/create', [TypeOfActivityController::class, 'create'])
        ->name('jenis_kegiatan.create');

    Route::post('/typeofactivity', [TypeOfActivityController::class, 'store'])
        ->name('jenis_kegiatan.store');

    Route::get('/typeofactivity/{id}/edit', [TypeOfActivityController::class, 'edit'])
        ->name('jenis_kegiatan.edit');

    Route::put('/typeofactivity/{id}', [TypeOfActivityController::class, 'update'])
        ->name('jenis_kegiatan.update');

    Route::delete('/typeofactivity/{id}', [TypeOfActivityController::class, 'destroy'])
        ->name('jenis_kegiatan.destroy');
});
