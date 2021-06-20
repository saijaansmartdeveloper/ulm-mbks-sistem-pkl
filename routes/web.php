<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonevController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Master\StudentController;
use App\Http\Controllers\ReportActivityController;
use App\Http\Controllers\StudentController as UserStudent;

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

Route::prefix('registrasi')->group(function () {
    Route::get('mahasiswa', [StudentController::class, 'register'])
        ->name('mahasiswa.register');

    Route::post('mahasiswa', [StudentController::class, 'register_store'])
        ->name('mahasiswa.register.store');
});

Route::group(['namespace' => 'auth'], function () {

    route::get('user/login',  [LoginController::class, 'showLoginForm'])->name('login');
    route::post('user/login',  [LoginController::class, 'login']);
    route::post('logout',  [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'super_admin'], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard_superuser'])->name('super_admin.dashboard')->middleware(['role:super_admin']);

        require __DIR__ . '/user/super_admin/user.php';
        require __DIR__ . '/user/super_admin/major.php';
        require __DIR__ . '/user/super_admin/student.php';
        require __DIR__ . '/user/super_admin/studyprogram.php';
        require __DIR__ . '/user/super_admin/typeofactivity.php';
    });

    Route::group(['prefix' => 'admin_prodi'], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard_adminprodi'])->name('admin_prodi.dashboard')->middleware(['role:admin_prodi']);

        require __DIR__ . '/user/admin_prodi/lecturer.php';
        require __DIR__ . '/user/admin_prodi/partner.php';
        require __DIR__ . '/user/admin_prodi/student.php';
        require __DIR__ . '/user/admin_prodi/activity.php';

    });

    Route::group(['prefix' => 'supervisor'], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard_supervisor'])->name('supervisor.dashboard')->middleware(['role:supervisor']);
    });

    require __DIR__ . '/public/announcement.php';

});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['as' => 'public.'], function () {

    Route::get('/', function () {
        return redirect()->route('public.user.form_login');
    });

    Route::prefix('{prefix}')->group(function () {
        Route::get('journal/print', [JournalController::class, 'print'])
            ->name('journal.print');

        Route::get('journal/{uuid}', [JournalController::class, 'show'])
            ->name('journal.show');

        Route::get('journal/{uuid}/edit', [JournalController::class, 'edit'])
            ->name('journal.edit');

        Route::post('journal/print', [JournalController::class, 'print'])
            ->name('journal.print.post');

        Route::post('comment', [JournalController::class, 'store_comment'])
            ->name('journal.comment.store');

        Route::delete('comment/{id}', [JournalController::class, 'destroy_comment'])
            ->name('journal.comment.destroy');

        Route::put('journal/status', [JournalController::class, 'update_status_any'])
            ->name('journal.update_status_any');

        Route::get('profile/{id}', [UserStudent::class, 'show'])
            ->name('student.show');

    });

    Route::prefix('lecturer')->group(function () {

        Route::get('laporan-kegitan', [ReportActivityController::class, 'index'])
            ->name('laporan-kegiatan.index');

        Route::get('laporan-kegitan/create', [ReportActivityController::class, 'create'])
            ->name('laporan-kegiatan.create');

        Route::get('laporan-kegitan/{id}', [ReportActivityController::class, 'show'])
            ->name('laporan-kegiatan.show');

        Route::post('laporan-kegitan', [ReportActivityController::class, 'store'])
            ->name('laporan-kegiatan.store');

        Route::delete('laporan-kegitan/{id}', [ReportActivityController::class, 'destroy'])
            ->name('laporan-kegiatan.destroy');
    });

    Route::prefix('student')->group(function () {

        // access journal
        Route::get('journal', [JournalController::class, 'index'])
            ->name('student.journal');

        Route::post('/store', [JournalController::class, 'store'])
            ->name('student.journal.store');

        Route::put('journal/{uuid}', [JournalController::class, 'update'])
            ->name('journal.update');

        Route::delete('journal/{uuid}', [JournalController::class, 'destroy'])
            ->name('journal.destroy');

        // access student
        Route::get('dashboard', [UserStudent::class, 'index'])
            ->name('student.index');

        Route::get('/{id}/edit', [UserStudent::class, 'edit'])
            ->name('student.edit');

        Route::put('/{id}/edit', [UserStudent::class, 'update'])
            ->name('student.update');

    });

    require __DIR__ . '/public/auth.php';
    require __DIR__ . '/public/activity.php';
    require __DIR__ . '/public/lecturer.php';
    // require __DIR__ . '/public/student.php';
    require __DIR__ . '/public/partner.php';
    // require __DIR__ . '/public/journal.php';
    require __DIR__ . '/public/monev.php';
});
