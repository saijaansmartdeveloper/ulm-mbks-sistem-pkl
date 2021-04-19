<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function() {
    Route::get('dashboard', [LecturerController::class, 'index'])
        ->name('lecturer.index');
});

Route::prefix('lecturer')->group(function() {
    Route::get('students', [StudentController::class, 'index'])
        ->name('lecturer.student');
});

Route::prefix('lecturer')->group(function() {
    Route::get('journals', [JournalController::class, 'show'])
        ->name('lecturer.journal.show');
});

Route::prefix('lecturer')->group(function() {
    Route::get('journals/{id}/verify', [JournalController::class, 'verify'])
        ->name('lecturer.journal.verify');
});

Route::prefix('lecturer')->group(function() {
    Route::post('journals/{id}/verify', [JournalController::class, 'verified'])
        ->name('lecturer.journal.verified');
});

