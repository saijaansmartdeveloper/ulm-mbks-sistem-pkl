<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Master\StudentController;
use App\Http\Controllers\AnnouncementController;

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

Route::get('register/mahasiswa', [StudentController::class, 'register'])
    ->name('mahasiswa.register');

Route::post('register/mahasiswa', [StudentController::class, 'register_store'])
    ->name('mahasiswa.register.store');


Route::group(['namespace' => 'auth'], function () {

    route::get('user/login',  [LoginController::class, 'showLoginForm'])->name('login');
    route::post('user/login',  [LoginController::class, 'login']);
    route::post('logout',  [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'super_admin'], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard_superuser'])->name('super_admin.dashboard')->middleware(['role:super_admin']);

        require __DIR__ . '/user/super_admin/user.php';
    });

    Route::group(['prefix' => 'admin_prodi'], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard_adminprodi'])->name('admin_prodi.dashboard')->middleware(['role:admin_prodi']);

        require __DIR__ . '/user/admin_prodi/lecturer.php';
        require __DIR__ . '/user/admin_prodi/partner.php';
        require __DIR__ . '/user/admin_prodi/student.php';
    });

    Route::group(['prefix' => 'supervisor'], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard_supervisor'])->name('supervisor.dashboard')->middleware(['role:supervisor']);
    });

    require __DIR__ . '/public/announcement.php';

});


Route::group(['prefix' => 'super_admin', 'middleware' => ['role:super_admin', 'auth']], function () {
    // require __DIR__ . '/user/super_admin/home.php';
    require __DIR__ . '/user/super_admin/major.php';
    require __DIR__ . '/user/super_admin/student.php';
    require __DIR__ . '/user/super_admin/studyprogram.php';
    require __DIR__ . '/user/super_admin/typeofactivity.php';
});

Route::group(['prefix' => 'admin_prodi', 'middleware' => ['role:admin_prodi', 'auth']], function () {

    require __DIR__ . '/user/admin_prodi/activity.php';
    // require __DIR__ . '/user/admin_prodi/home.php';

});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['as' => 'public.'], function () {

    Route::get('/', function () {
        return redirect()->route('public.user.form_login');
    });

    require __DIR__ . '/public/auth.php';
    require __DIR__ . '/public/activity.php';
    require __DIR__ . '/public/lecturer.php';
    require __DIR__ . '/public/student.php';
    require __DIR__ . '/public/partner.php';
    require __DIR__ . '/public/journal.php';
    require __DIR__ . '/public/monev.php';
});
