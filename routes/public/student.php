<?php


use App\Http\Controllers\JournalController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MonevController;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('dashboard', [StudentController::class, 'index'])
        ->name('student.index');;
//    Route::get('jurnal/list', [JurnalController::class, 'getjurnal'])->name('jurnal.list');
//    Route::get('jurnal', [JurnalController::class, 'index'])->name('jurnal.index');
//    Route::get('jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');
//    Route::post('jurnal', [JurnalController::class, 'store'])->name('jurnal.store');
//    Route::get('jurnal/{id}/edit', [JurnalController::class, 'edit'])->name('jurnal.edit');
//    Route::put('jurnal/{id}', [JurnalController::class, 'update'])->name('jurnal.update');
//    Route::delete('jurnal/{id}', [JurnalController::class, 'destroy'])->name('jurnal.destroy');





});

// Route::prefix('lecturer')->group(function () {
//     Route::get('students', [StudentController::class, 'index'])
//         ->name('lecturer.student');
// });

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

// use App\Http\Controllers\StudentController;
// use Illuminate\Support\Facades\Route;

// Route::prefix('student')->group(function() {
//     Route::get('dashboard', [StudentController::class, 'index'])
//         ->name('student.index');
// });

