<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:super_admin'], function () {
        Route::group(['namespace' => 'Supervisor'], function () {
            Route::get('supervisor/list', "SupervisorController@getSupervisor")->name('supervisor.list');


            Route::get('/supervisor', "SupervisorController@index")->name('supervisor.index');
            Route::get('/supervisor/create', "SupervisorController@create")->name('supervisor.create');
        });

        Route::group(['namespace' => 'Jurusan'], function () {
            Route::get('jurusan/list', "JurusanController@getJurusan")->name('jurusan.list');


            Route::get('/jurusan', "JurusanController@index")->name('jurusan.index');
            Route::get('/jurusan/create', "JurusanController@create")->name('jurusan.create');
            Route::post('/jurusan', "JurusanController@store")->name('jurusan.store');
            Route::get('/jurusan/{id}/edit', "JurusanController@edit")->name('jurusan.edit');
            Route::put('/jurusan/{id}', "JurusanController@update")->name('jurusan.update');
            Route::delete('/jurusan/{id}', "JurusanController@destroy")->name('jurusan.destroy');
        });

        Route::group(['namespace' => 'Prodi'], function () {
            Route::get('prodi/list', "ProdiController@getProdi")->name('prodi.list');


            Route::get('/prodi', "ProdiController@index")->name('prodi.index');
            Route::get('/prodi/create', "ProdiController@create")->name('prodi.create');
            Route::post('/prodi', "ProdiController@store")->name('prodi.store');
            Route::get('/prodi/{id}/edit', "ProdiController@edit")->name('prodi.edit');
            Route::put('/prodi/{id}', "ProdiController@update")->name('prodi.update');
            Route::delete('/prodi/{id}', "ProdiController@destroy")->name('prodi.destroy');
        });

        Route::group(['namespace' => 'AdminProdi'], function () {
            Route::get('admin_prodi/list', "AdminProdiController@getAdminProdi")->name('admin_prodi.list');


            Route::get('/admin_prodi', "AdminProdiController@index")->name('admin_prodi.index');
            Route::get('/admin_prodi/create', "AdminProdiController@create")->name('admin_prodi.create');
            Route::post('/admin_prodi', "AdminProdiController@store")->name('admin_prodi.store');
            Route::get('/admin_prodi/{id}/edit', "AdminProdiController@edit")->name('admin_prodi.edit');
            Route::put('/admin_prodi/{id}', "AdminProdiController@update")->name('admin_prodi.update');
            Route::delete('/admin_prodi/{id}', "AdminProdiController@destroy")->name('admin_prodi.destroy');
        });
    });

    Route::group(['middleware' => 'role:admin_prodi'], function(){
        Route::group(['namespace' => 'dosen'], function(){
            Route::get('dosen/list', "DosenController@getDosen")->name('dosen.list');


            Route::get('/dosen', "DosenController@index")->name('dosen.index');
            Route::get('/dosen/create', "DosenController@create")->name('dosen.create');
            Route::post('/dosen', "DosenController@store")->name('dosen.store');
            Route::get('/dosen/{id}/edit', "DosenController@edit")->name('dosen.edit');
            Route::put('/dosen/{id}', "DosenController@update")->name('dosen.update');
            Route::delete('/dosen/{id}', "DosenController@destroy")->name('dosen.destroy');
        });

        Route::group(['namespace' => 'Mitra'], function(){
            Route::get('mitra/list', "MitraController@getMitra")->name('mitra.list');


            Route::get('/mitra', "MitraController@index")->name('mitra.index');
            Route::get('/mitra/create', "MitraController@create")->name('mitra.create');
            Route::post('/mitra', "MitraController@store")->name('mitra.store');
            Route::get('/mitra/{id}/edit', "MitraController@edit")->name('mitra.edit');
            Route::put('/mitra/{id}', "MitraController@update")->name('mitra.update');
            Route::delete('/mitra/{id}', "MitraController@destroy")->name('mitra.destroy');
        });
        Route::group(['namespace' => 'Mahasiswa'], function(){
            Route::get('mahasiswa/list', "MahasiswaController@getMahasiswa")->name('mahasiswa.list');


            Route::get('/mahasiswa', "MahasiswaController@index")->name('mahasiswa.index');
            Route::get('/mahasiswa/create', "MahasiswaController@create")->name('mahasiswa.create');
            Route::post('/mahasiswa', "MahasiswaController@store")->name('mahasiswa.store');
            Route::get('/mahasiswa/{id}/edit', "MahasiswaController@edit")->name('mahasiswa.edit');
            Route::put('/mahasiswa/{id}', "MahasiswaController@update")->name('mahasiswa.update');
            Route::delete('/mahasiswa/{id}', "MahasiswaController@destroy")->name('mahasiswa.destroy');
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'public', 'as' => 'public.'],function () {
    require __DIR__ . '/public/auth.php';
    require __DIR__ . '/public/lecturer.php';
});


