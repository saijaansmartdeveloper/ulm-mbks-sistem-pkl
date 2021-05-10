<?php

use App\Http\Controllers\Admin\SuperAdmin\HomeController;
use App\Http\Controllers\Master\AnnouncementController;
use App\Http\Controllers\Master\MajorController;
use App\Http\Controllers\Master\StudyProgramController;
use App\Http\Controllers\Master\TypeOfActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->name('super_admin.dashboard');

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
    Route::get('pengumuman/list', [AnnouncementController::class, 'getpengumuman'])->name('pengumuman.list');


    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [AnnouncementController::class, 'create'])->name('pengumuman.create');
    Route::post('/pengumuman', [AnnouncementController::class, 'store'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [AnnouncementController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/pengumuman/{id}', [AnnouncementController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [AnnouncementController::class, 'destroy'])->name('pengumuman.destroy');
});
Route::group(['namespace' => 'Acitivity'], function () {
    Route::get('jenis_kegiatan/list', [TypeOfActivityController::class, 'getJenisKegiatan'])->name('jenis_kegiatan.list');


    Route::get('/jenis_kegiatan', [TypeOfActivityController::class, 'index'])->name('jenis_kegiatan.index');
    Route::get('/jenis_kegiatan/create', [TypeOfActivityController::class, 'create'])->name('jenis_kegiatan.create');
    Route::post('/jenis_kegiatan', [TypeOfActivityController::class, 'store'])->name('jenis_kegiatan.store');
    Route::get('/jenis_kegiatan/{id}/edit', [TypeOfActivityController::class, 'edit'])->name('jenis_kegiatan.edit');
    Route::put('/jenis_kegiatan/{id}', [TypeOfActivityController::class, 'update'])->name('jenis_kegiatan.update');
    Route::delete('/jenis_kegiatan/{id}', [TypeOfActivityController::class, 'destroy'])->name('jenis_kegiatan.destroy');
});




Route::group(['namespace' => 'Major'], function () {
    Route::get('jurusan/list', [MajorController::class, 'getJurusan'])->name('jurusan.list');


    Route::get('/jurusan', [MajorController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create', [MajorController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan', [MajorController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{id}/edit', [MajorController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{id}', [MajorController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{id}', [MajorController::class, 'destroy'])->name('jurusan.destroy');
});

Route::group(['namespace' => 'StudyProgram'], function () {
    Route::get('prodi/list', [StudyProgramController::class, 'getProdi'])->name('prodi.list');


    Route::get('/prodi', [StudyProgramController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [StudyProgramController::class, 'create'])->name('prodi.create');
    Route::post('/prodi', [StudyProgramController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{id}/edit', [StudyProgramController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{id}', [StudyProgramController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{id}', [StudyProgramController::class, 'destroy'])->name('prodi.destroy');
});
