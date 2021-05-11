<?php

use App\Http\Controllers\Master\ActivityController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Activity'], function () {

    Route::get('/activity', [ActivityController::class, 'index'])
        ->name('magang.index');

    Route::get('/activity/create', [ActivityController::class, 'create'])
        ->name('magang.create');

    Route::post('/activity', [ActivityController::class, 'store'])
        ->name('magang.store');

    Route::get('/activity/{id}', [ActivityController::class, 'show'])
        ->name('magang.show');

    Route::get('/activity/{id}/edit', [ActivityController::class, 'edit'])
        ->name('magang.edit');

    Route::put('/activity/{id}', [ActivityController::class, 'update'])
        ->name('magang.update');

    Route::delete('/activity/{id}', [ActivityController::class, 'destroy'])
        ->name('magang.destroy');
});
