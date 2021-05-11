<?php

use App\Http\Controllers\Master\MajorController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Major'], function () {

    Route::get('/major', [MajorController::class, 'index'])
        ->name('jurusan.index');

    Route::get('/major/create', [MajorController::class, 'create'])
        ->name('jurusan.create');

    Route::post('/major', [MajorController::class, 'store'])
        ->name('jurusan.store');

    Route::get('/major/{id}/edit', [MajorController::class, 'edit'])
        ->name('jurusan.edit');

    Route::put('/major/{id}', [MajorController::class, 'update'])
        ->name('jurusan.update');

    Route::delete('/major/{id}', [MajorController::class, 'destroy'])
        ->name('jurusan.destroy');
});
