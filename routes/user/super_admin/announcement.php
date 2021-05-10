<?php

use App\Http\Controllers\Master\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Announcement'], function () {

    Route::get('/announcement', [AnnouncementController::class, 'index'])
        ->name('pengumuman.index');

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])
        ->name('pengumuman.create');

    Route::post('/announcement', [AnnouncementController::class, 'store'])
        ->name('pengumuman.store');

    Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])
        ->name('pengumuman.edit');

    Route::put('/announcement/{id}', [AnnouncementController::class, 'update'])
        ->name('pengumuman.update');

    Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])
        ->name('pengumuman.destroy');
});
