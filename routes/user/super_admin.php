<?php

use App\Http\Controllers\AdminProdi\AdminProdiController;
use App\Http\Controllers\Jurusan\JurusanController;
use App\Http\Controllers\Kegiatan\JenisKegiatanController;
use App\Http\Controllers\Pengumuman\PengumumanController;
use App\Http\Controllers\Prodi\ProdiController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\UserController;
use App\Models\TypeOfActivity;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'User'], function () {
    Route::get('user/list', [UserController::class, 'getUser'])->name('user.list');


    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
Route::group(['namespace' => 'Announcement'], function () {
    Route::get('pengumuman/list', [PengumumanController::class, 'getpengumuman'])->name('pengumuman.list');


    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
});
Route::group(['namespace' => 'Activity'], function () {
    Route::get('jenis_kegiatan/list', [JenisKegiatanController::class, 'getJenisKegiatan'])->name('jenis_kegiatan.list');


    Route::get('/jenis_kegiatan', [JenisKegiatanController::class, 'index'])->name('jenis_kegiatan.index');
    Route::get('/jenis_kegiatan/create', [JenisKegiatanController::class, 'create'])->name('jenis_kegiatan.create');
    Route::post('/jenis_kegiatan', [JenisKegiatanController::class, 'store'])->name('jenis_kegiatan.store');
    Route::get('/jenis_kegiatan/{id}/edit', [JenisKegiatanController::class, 'edit'])->name('jenis_kegiatan.edit');
    Route::put('/jenis_kegiatan/{id}', [JenisKegiatanController::class, 'update'])->name('jenis_kegiatan.update');
    Route::delete('/jenis_kegiatan/{id}', [JenisKegiatanController::class, 'destroy'])->name('jenis_kegiatan.destroy');
});




Route::group(['namespace' => 'Major'], function () {
    Route::get('jurusan/list', [JurusanController::class, 'getJurusan'])->name('jurusan.list');


    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
});

Route::group(['namespace' => 'StudyProgram'], function () {
    Route::get('prodi/list', [ProdiController::class, 'getProdi'])->name('prodi.list');


    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
});
