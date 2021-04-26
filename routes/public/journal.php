<?php

use App\Http\Controllers\JournalController;
use Illuminate\Support\Facades\Route;

Route::prefix('journal')->group(function () {
    Route::get('/create', [JournalController::class, 'create'])->name('journal.create');
    Route::get('/print', [JournalController::class, 'print'])->name('journal.print');
    Route::get('/{uuid}', [JournalController::class, 'show'])->name('journal.show');
    Route::get('/{uuid}/edit', [JournalController::class, 'edit'])->name('journal.edit');

    Route::post('/store', [JournalController::class, 'store'])->name('journal.store');

    Route::get('/', [JournalController::class, 'index'])->name('journal.index');

    Route::put('/{uuid}', [JournalController::class, 'update'])->name('journal.update');
});
