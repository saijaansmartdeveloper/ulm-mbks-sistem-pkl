<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\LecturerController;
use Illuminate\Support\Facades\Route;

Route::prefix('journal')->group(function () {

    Route::get('/', [JournalController::class, 'index'])
        ->name('journal.index');

    Route::get('/create', [JournalController::class, 'create'])
        ->name('journal.create');

    Route::get('/print', [JournalController::class, 'print'])
        ->name('journal.print');

    Route::get('/{uuid}', [JournalController::class, 'show'])->name('journal.show');
    Route::get('/{uuid}/edit', [JournalController::class, 'edit'])->name('journal.edit');
    Route::post('/print', [JournalController::class, 'print_proc'])->name('journal.print.post');
    Route::put('/{uuid}', [JournalController::class, 'update'])->name('journal.update');
    Route::put('/', [LecturerController::class, 'update_status_all'])->name('journal.update_status_all');

});
