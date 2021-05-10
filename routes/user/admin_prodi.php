<?php

use App\Http\Controllers\Admin\AdminProdi\HomeController;
use App\Http\Controllers\Master\ActivityController;
use App\Http\Controllers\Master\LecturerController;
use App\Http\Controllers\Master\StudentController;
use App\Http\Controllers\Master\PartnerController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [HomeController::class, 'index'])->name('admin_prodi.dashboard');

Route::group(['namespace' => 'dosen'], function () {
    Route::get('dosen/list', [LecturerController::class, 'getDosen'])->name('dosen.list');


    Route::get('/dosen', [LecturerController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [LecturerController::class, 'create'])->name('dosen.create');
    Route::post('/dosen', [LecturerController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [LecturerController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [LecturerController::class, 'update'])->name('dosen.update');
    Route::get('/dosen/{id}', [LecturerController::class, 'show'])->name('dosen.show');
    Route::delete('/dosen/{id}', [LecturerController::class, 'destroy'])->name('dosen.destroy');
});

Route::group(['namespace' => 'Partner'], function () {
    Route::get('mitra/list', [PartnerController::class, 'getMitra'])->name('mitra.list');


    Route::get('/mitra', [PartnerController::class, 'index'])->name('mitra.index');
    Route::get('/mitra/create', [PartnerController::class, 'create'])->name('mitra.create');
    Route::post('/mitra', [PartnerController::class, 'store'])->name('mitra.store');
    Route::get('/mitra/{id}', [PartnerController::class, 'show'])->name('mitra.show');
    Route::get('/mitra/{id}/edit', [PartnerController::class, 'edit'])->name('mitra.edit');
    Route::put('/mitra/{id}', [PartnerController::class, 'update'])->name('mitra.update');
    Route::delete('/mitra/{id}', [PartnerController::class, 'destroy'])->name('mitra.destroy');
});

Route::group(['namespace' => 'Student'], function () {
    Route::get('mahasiswa/list', [StudentController::class, 'getMahasiswa'])->name('mahasiswa.list');


    Route::get('/mahasiswa', [StudentController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [StudentController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [StudentController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}', [StudentController::class, 'Show'])->name('mahasiswa.show');
    Route::get('/mahasiswa/{id}/edit', [StudentController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [StudentController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [StudentController::class, 'destroy'])->name('mahasiswa.destroy');
});

Route::group(['namespace' => 'Activity'], function () {


    Route::get('magang/list', [ActivityController::class, 'getMagang'])->name('magang.list');


    Route::get('/magang', [ActivityController::class, 'index'])->name('magang.index');
    Route::get('/magang/create', [ActivityController::class, 'create'])->name('magang.create');
    Route::post('/magang', [ActivityController::class, 'store'])->name('magang.store');
    Route::get('/magang/{id}', [ActivityController::class, 'show'])->name('magang.show');
    Route::get('/magang/{id}/edit', [ActivityController::class, 'edit'])->name('magang.edit');
    Route::put('/magang/{id}', [ActivityController::class, 'update'])->name('magang.update');
    Route::delete('/magang/{id}', [ActivityController::class, 'destroy'])->name('magang.destroy');
});
