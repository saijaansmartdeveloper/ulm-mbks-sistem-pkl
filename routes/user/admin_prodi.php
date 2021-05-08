<?php

use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Kegiatan\JenisKegiatanController;
use App\Http\Controllers\Kegiatan\MagangController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mitra\MitraController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'dosen'], function () {
    Route::get('dosen/list', [DosenController::class, 'getDosen'])->name('dosen.list');


    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
});

Route::group(['namespace' => 'Partner'], function () {
    Route::get('mitra/list', [MitraController::class, 'getMitra'])->name('mitra.list');


    Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.index');
    Route::get('/mitra/create', [MitraController::class, 'create'])->name('mitra.create');
    Route::post('/mitra', [MitraController::class, 'store'])->name('mitra.store');
    Route::get('/mitra/{id}', [MitraController::class, 'show'])->name('mitra.show');
    Route::get('/mitra/{id}/edit', [MitraController::class, 'edit'])->name('mitra.edit');
    Route::put('/mitra/{id}', [MitraController::class, 'update'])->name('mitra.update');
    Route::delete('/mitra/{id}', [MitraController::class, 'destroy'])->name('mitra.destroy');
});

Route::group(['namespace' => 'Student'], function () {
    Route::get('mahasiswa/list', [MahasiswaController::class, 'getMahasiswa'])->name('mahasiswa.list');


    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'Show'])->name('mahasiswa.show');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

Route::group(['namespace' => 'Activity'], function () {


    Route::get('magang/list', [MagangController::class, 'getMagang'])->name('magang.list');


    Route::get('/magang', [MagangController::class, 'index'])->name('magang.index');
    Route::get('/magang/create', [MagangController::class, 'create'])->name('magang.create');
    Route::post('/magang', [MagangController::class, 'store'])->name('magang.store');
    Route::get('/magang/{id}', [MagangController::class, 'show'])->name('magang.show');
    Route::get('/magang/{id}/edit', [MagangController::class, 'edit'])->name('magang.edit');
    Route::put('/magang/{id}', [MagangController::class, 'update'])->name('magang.update');
    Route::delete('/magang/{id}', [MagangController::class, 'destroy'])->name('magang.destroy');
});
