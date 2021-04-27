<?php

use App\Http\Controllers\AdminProdi\AdminProdiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Jurusan\JurusanController;
use App\Http\Controllers\Kegiatan\JenisKegiatanController;
use App\Http\Controllers\Kegiatan\MagangController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mitra\MitraController;
use App\Http\Controllers\Pengumuman\PengumumanController;
use App\Http\Controllers\Prodi\ProdiController;
use App\Http\Controllers\Supervisor\SupervisorController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('public.user.form_login');
});

Route::get('register/mahasiswa', [MahasiswaController::class, 'register'])->name('mahasiswa.register');
Route::post('register/mahasiswa', [MahasiswaController::class, 'register_store'])->name('mahasiswa.register.store');
// route::get('register/mahasiswa', 'Mahasiswa\MahasiswaController@register')->name('mahasiswa.register');
// route::post('register/mahasiswa', 'Mahasiswa\MahasiswaController@register_store')->name('mahasiswa.register.store');


Route::group(['namespace' => 'auth'], function () {

    route::get('user/login',  [LoginController::class, 'showLoginForm'])->name('login');
    route::post('user/login',  [LoginController::class, 'login']);
    route::post('logout',  [LoginController::class, 'logout'])->name('logout');

    // route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // // route::get('');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:super_admin'], function () {

        Route::group(['namespace' => 'Pengumuman'], function () {
            Route::get('pengumuman/list', [PengumumanController::class, 'getpengumuman'])->name('pengumuman.list');


            Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
            Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
            Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
            Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
            Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
            Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
        });
        Route::group(['namespace' => 'Supervisor'], function () {
            Route::get('supervisor/list', [SupervisorController::class, 'getSupervisor'])->name('supervisor.list');


            Route::get('/supervisor', [SupervisorController::class, 'index'])->name('supervisor.index');
            Route::get('/supervisor/create', [SupervisorController::class, 'create'])->name('supervisor.create');
            Route::post('/supervisor', [SupervisorController::class, 'store'])->name('supervisor.store');
            Route::get('/supervisor/{id}/edit', [SupervisorController::class, 'edit'])->name('supervisor.edit');
            Route::put('/supervisor/{id}', [SupervisorController::class, 'update'])->name('supervisor.update');
            Route::delete('/supervisor/{id}', [SupervisorController::class, 'destroy'])->name('supervisor.destroy');
        });

        Route::group(['namespace' => 'Jurusan'], function () {
            Route::get('jurusan/list', [JurusanController::class, 'getJurusan'])->name('jurusan.list');


            Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
            Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
            Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
            Route::get('/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
            Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
            Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
        });

        Route::group(['namespace' => 'Prodi'], function () {
            Route::get('prodi/list', [ProdiController::class, 'getProdi'])->name('prodi.list');


            Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
            Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
            Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
            Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
            Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
            Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
        });

        Route::group(['namespace' => 'AdminProdi'], function () {
            Route::get('admin_prodi/list', [AdminProdiController::class, 'getAdminProdi'])->name('admin_prodi.list');


            Route::get('/admin_prodi', [AdminProdiController::class, 'index'])->name('admin_prodi.index');
            Route::get('/admin_prodi/create', [AdminProdiController::class, 'create'])->name('admin_prodi.create');
            Route::post('/admin_prodi', [AdminProdiController::class, 'store'])->name('admin_prodi.store');
            Route::get('/admin_prodi/{id}/edit', [AdminProdiController::class, 'edit'])->name('admin_prodi.edit');
            Route::put('/admin_prodi/{id}', [AdminProdiController::class, 'update'])->name('admin_prodi.update');
            Route::delete('/admin_prodi/{id}', [AdminProdiController::class, 'destroy'])->name('admin_prodi.destroy');
        });
    });

    Route::group(['middleware' => 'role:admin_prodi'], function () {
        Route::group(['namespace' => 'dosen'], function () {
            Route::get('dosen/list', [DosenController::class, 'getDosen'])->name('dosen.list');


            Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
            Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
            Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
            Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
            Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
            Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
        });

        Route::group(['namespace' => 'Mitra'], function () {
            Route::get('mitra/list', [MitraController::class, 'getMitra'])->name('mitra.list');


            Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.index');
            Route::get('/mitra/create', [MitraController::class, 'create'])->name('mitra.create');
            Route::post('/mitra', [MitraController::class, 'store'])->name('mitra.store');
            Route::get('/mitra/{id}/edit', [MitraController::class, 'edit'])->name('mitra.edit');
            Route::put('/mitra/{id}', [MitraController::class, 'update'])->name('mitra.update');
            Route::delete('/mitra/{id}', [MitraController::class, 'destroy'])->name('mitra.destroy');
        });

        Route::group(['namespace' => 'Mahasiswa'], function () {
            Route::get('mahasiswa/list', [MahasiswaController::class, 'getMahasiswa'])->name('mahasiswa.list');


            Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
            Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
            Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
            Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
            Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
            Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
        });

        Route::group(['namespace' => 'Kegiatan'], function () {
            Route::get('jenis_kegiatan/list', [JenisKegiatanController::class, 'getJenisKegiatan'])->name('jenis_kegiatan.list');


            Route::get('/jenis_kegiatan', [JenisKegiatanController::class, 'index'])->name('jenis_kegiatan.index');
            Route::get('/jenis_kegiatan/create', [JenisKegiatanController::class, 'create'])->name('jenis_kegiatan.create');
            Route::post('/jenis_kegiatan', [JenisKegiatanController::class, 'store'])->name('jenis_kegiatan.store');
            Route::get('/jenis_kegiatan/{id}/edit', [JenisKegiatanController::class, 'edit'])->name('jenis_kegiatan.edit');
            Route::put('/jenis_kegiatan/{id}', [JenisKegiatanController::class, 'update'])->name('jenis_kegiatan.update');
            Route::delete('/jenis_kegiatan/{id}', [JenisKegiatanController::class, 'destroy'])->name('jenis_kegiatan.destroy');


            Route::get('magang/list', [MagangController::class, 'getMagang'])->name('magang.list');


            Route::get('/magang', [MagangController::class, 'index'])->name('magang.index');
            Route::get('/magang/create', [MagangController::class, 'create'])->name('magang.create');
            Route::post('/magang', [MagangController::class, 'store'])->name('magang.store');
            Route::get('/magang/{id}/edit', [MagangController::class, 'edit'])->name('magang.edit');
            Route::put('/magang/{id}', [MagangController::class, 'update'])->name('magang.update');
            Route::delete('/magang/{id}', [MagangController::class, 'destroy'])->name('magang.destroy');
        });
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'public', 'as' => 'public.'], function () {

    Route::get('/', function () {
        return redirect()->route('public.user.form_login');
    });

    require __DIR__ . '/public/auth.php';
    require __DIR__ . '/public/lecturer.php';
    require __DIR__ . '/public/student.php';
    require __DIR__ . '/public/internship.php';
    require __DIR__ . '/public/journal.php';
});
