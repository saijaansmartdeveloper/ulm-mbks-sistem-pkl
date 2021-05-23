<?php

use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MonevController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function () {

    Route::get('monev', [MonevController::class, 'index'])->name('monev.index');

    Route::get('dashboard', [LecturerController::class, 'index'])
        ->name('lecturer.index');

    Route::get('/{id}', [LecturerController::class, 'show'])
        ->name('lecturer.show');

    Route::get('/{id}/edit', [LecturerController::class, 'edit'])
        ->name('lecturer.edit');

    Route::put('/{id}/edit', [LecturerController::class, 'update'])
        ->name('lecturer.update');;

    Route::get('guidance', [LecturerController::class, 'guidance'])
        ->name('lecturer.guidance');

    Route::get('monev/list', [MonevController::class, 'getMonev'])->name('monev.list');
    Route::get('monev/create', [MonevController::class, 'create'])->name('monev.create');
    Route::post('monev', [MonevController::class, 'store'])->name('monev.store');
    Route::get('monev/{id}/edit', [MonevController::class, 'edit'])->name('monev.edit');
    Route::put('monev/{id}', [MonevController::class, 'update'])->name('monev.update');
    Route::get('monev/{id}', [MonevController::class, 'show'])->name('monev.show');
    Route::delete('monev/{id}', [MonevController::class, 'destroy'])->name('monev.destroy');

    Route::get('mahasiswa_bimbingan/list', [LecturerController::class, 'getListMahasiswaBimbingan'])->name('lecturer.student_guidance.list');
    Route::get('mahasiswa_bimbingan', [LecturerController::class, 'index_journal'])->name('lecturer.student_guidance.index');
    Route::get('mahasiswa_bimbingan/{id}', [LecturerController::class, 'show_student_detail'])->name('lecturer.student_guidance.show');
    Route::get('mahasiswa_bimbingan/jurnal/{id}', [LecturerController::class, 'show_student_journal'])->name('lecturer.student_guidance.show_journal');
    Route::put('mahasiswa_bimbingan/jurnal/{id}', [LecturerController::class, 'update_journal'])->name('lecturer.student_guidance.update_journal');
});

Route::prefix('lecturer')->group(function () {
    Route::get('students', [StudentController::class, 'index'])
        ->name('lecturer.student');
});

// Route::prefix('lecturer')->group(function () {
//     Route::get('journals', [JournalController::class, 'show'])
//         ->name('lecturer.journal.show');
// });

// Route::prefix('lecturer')->group(function () {
//     Route::get('journals/{id}/verify', [JournalController::class, 'verify'])
//         ->name('lecturer.journal.verify');
// });

// Route::prefix('lecturer')->group(function () {
//     Route::post('journals/{id}/verify', [JournalController::class, 'verified'])
//         ->name('lecturer.journal.verified');
// });
