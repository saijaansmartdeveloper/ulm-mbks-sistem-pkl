<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MonevController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function () {
    Route::get('dashboard', [LecturerController::class, 'index'])
        ->name('lecturer.index');
    Route::get('monev/list', [MonevController::class, 'getMonev'])->name('monev.list');
    Route::get('monev', [MonevController::class, 'index'])->name('monev.index');
    Route::get('monev/create', [MonevController::class, 'create'])->name('monev.create');
    Route::post('monev', [MonevController::class, 'store'])->name('monev.store');
    Route::get('monev/{id}/edit', [MonevController::class, 'edit'])->name('monev.edit');
    Route::put('monev/{id}', [MonevController::class, 'update'])->name('monev.update');
    Route::delete('monev/{id}', [MonevController::class, 'destroy'])->name('monev.destroy');




});

Route::prefix('lecturer')->group(function () {
    Route::get('students', [StudentController::class, 'index'])
        ->name('lecturer.student');
});

Route::prefix('lecturer')->group(function () {
    Route::get('journals', [JournalController::class, 'show'])
        ->name('lecturer.journal.show');
});

Route::prefix('lecturer')->group(function () {
    Route::get('journals/{id}/verify', [JournalController::class, 'verify'])
        ->name('lecturer.journal.verify');
});

Route::prefix('lecturer')->group(function () {
    Route::post('journals/{id}/verify', [JournalController::class, 'verified'])
        ->name('lecturer.journal.verified');
});
