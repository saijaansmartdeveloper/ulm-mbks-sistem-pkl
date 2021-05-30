<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;

Route::group(['namespace' => 'Announcement'], function () {

    Route::get('/announcement', [AnnouncementController::class, 'index'])
        ->name('pengumuman');

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])
        ->name('pengumuman.create');

    Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])
        ->name('pengumuman.show');

    Route::post('/announcement', [AnnouncementController::class, 'store'])
        ->name('pengumuman.store');

    Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])
        ->name('pengumuman.edit');

    Route::put('/announcement/{id}', [AnnouncementController::class, 'update'])
        ->name('pengumuman.update');

    Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])
        ->name('pengumuman.destroy');
});
