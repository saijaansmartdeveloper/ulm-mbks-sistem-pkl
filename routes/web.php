<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
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
// route::get('register/mahasiswa', 'Student\MahasiswaController@register')->name('mahasiswa.register');
// route::post('register/mahasiswa', 'Student\MahasiswaController@register_store')->name('mahasiswa.register.store');


Route::group(['namespace' => 'auth'], function () {

    route::get('user/login',  [LoginController::class, 'showLoginForm'])->name('login');
    route::post('user/login',  [LoginController::class, 'login']);
    route::post('logout',  [LoginController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => 'super_admin', 'middleware' => ['role:super_admin', 'auth']], function () {
    require __DIR__ . '/user/super_admin.php';
});

Route::group(['prefix' => 'admin_prodi', 'middleware' => ['role:admin_prodi', 'auth']], function () {
    require __DIR__ . '/user/admin_prodi.php';
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'public', 'as' => 'public.'], function () {

    Route::get('/', function () {
        return redirect()->route('public.user.form_login');
    });

    require __DIR__ . '/public/auth.php';
    require __DIR__ . '/public/lecturer.php';
    require __DIR__ . '/public/student.php';
    require __DIR__ . '/public/partner.php';
    require __DIR__ . '/public/activity.php';
    require __DIR__ . '/public/journal.php';
});
