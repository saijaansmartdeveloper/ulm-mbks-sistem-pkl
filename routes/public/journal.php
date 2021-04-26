<?php

use App\Http\Controllers\JournalController;
use Illuminate\Support\Facades\Route;

Route::prefix('journal')->group(function () {
    Route::get('/create', [JournalController::class, 'create'])->name('journal.create');
    Route::post('/store', [JournalController::class, 'store'])->name('journal.store');

    Route::get('/', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/{uuid}', [JournalController::class, 'show'])->name('journal.show');
});
