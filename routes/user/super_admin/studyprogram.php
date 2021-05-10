<?php

use App\Http\Controllers\Master\StudyProgramController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'StudyProgram'], function () {

    Route::get('/studyprogram', [StudyProgramController::class, 'index'])
        ->name('prodi.index');

    Route::get('/studyprogram/create', [StudyProgramController::class, 'create'])
        ->name('prodi.create');

    Route::post('/studyprogram', [StudyProgramController::class, 'store'])
        ->name('prodi.store');

    Route::get('/studyprogram/{id}/edit', [StudyProgramController::class, 'edit'])
        ->name('prodi.edit');

    Route::put('/studyprogram/{id}', [StudyProgramController::class, 'update'])
        ->name('prodi.update');

    Route::delete('/studyprogram/{id}', [StudyProgramController::class, 'destroy'])
        ->name('prodi.destroy');
});
