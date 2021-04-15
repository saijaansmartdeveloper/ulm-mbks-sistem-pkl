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
            Route::get('supervisor/list', "SupervisorController@getSupervisor");


            Route::get('/supervisor', "SupervisorController@index");
            Route::get('/supervisor/create', "SupervisorController@create");
        });

        Route::group(['namespace' => 'Jurusan'], function () {
            Route::get('jurusan/list', "JurusanController@getJurusan");


            Route::get('/jurusan', "JurusanController@index");
            Route::get('/jurusan/create', "JurusanController@create");
            Route::post('/jurusan', "JurusanController@store");
            Route::get('/jurusan/{id}/edit', "JurusanController@edit");
            Route::put('/jurusan/{id}', "JurusanController@update");
            Route::delete('/jurusan/{id}', "JurusanController@destroy");
        });

        Route::group(['namespace' => 'Prodi'], function () {
            Route::get('prodi/list', "ProdiController@getProdi");


            Route::get('/prodi', "ProdiController@index");
            Route::get('/prodi/create', "ProdiController@create");
            Route::post('/prodi', "ProdiController@store");
            Route::get('/prodi/{id}/edit', "ProdiController@edit");
            Route::put('/prodi/{id}', "ProdiController@update");
            Route::delete('/prodi/{id}', "ProdiController@destroy");
        });

        Route::group(['namespace' => 'AdminProdi'], function () {
            Route::get('admin_prodi/list', "AdminProdiController@getAdminProdi");


            Route::get('/admin_prodi', "AdminProdiController@index");
            Route::get('/admin_prodi/create', "AdminProdiController@create");
            Route::post('/admin_prodi', "AdminProdiController@store");
            Route::get('/admin_prodi/{id}/edit', "AdminProdiController@edit");
            Route::put('/admin_prodi/{id}', "AdminProdiController@update");
            Route::delete('/admin_prodi/{id}', "AdminProdiController@destroy");
        });
    });

    Route::group(['middleware' => 'role:admin_prodi'], function(){
        Route::group(['namespace' => 'dosen'], function(){
            Route::get('dosen/list', "DosenController@getDosen");


            Route::get('/dosen', "DosenController@index");
            Route::get('/dosen/create', "DosenController@create");
            Route::post('/dosen', "DosenController@store");
            Route::get('/dosen/{id}/edit', "DosenController@edit");
            Route::put('/dosen/{id}', "DosenController@update");
            Route::delete('/dosen/{id}', "DosenController@destroy");
        });

        Route::group(['namespace' => 'Mitra'], function(){
            Route::get('mitra/list', "MitraController@getMitra");


            Route::get('/mitra', "MitraController@index");
            Route::get('/mitra/create', "MitraController@create");
            Route::post('/mitra', "MitraController@store");
            Route::get('/mitra/{id}/edit', "MitraController@edit");
            Route::put('/mitra/{id}', "MitraController@update");
            Route::delete('/mitra/{id}', "MitraController@destroy");
        });
        Route::group(['namespace' => 'Mahasiswa'], function(){
            Route::get('mahasiswa/list', "MahasiswaController@getMahasiswa");


            Route::get('/mahasiswa', "MahasiswaController@index");
            Route::get('/mahasiswa/create', "MahasiswaController@create");
            Route::post('/mahasiswa', "MahasiswaController@store");
            Route::get('/mahasiswa/{id}/edit', "MahasiswaController@edit");
            Route::put('/mahasiswa/{id}', "MahasiswaController@update");
            Route::delete('/mahasiswa/{id}', "MahasiswaController@destroy");
        });
    });
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
