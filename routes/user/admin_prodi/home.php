<?php

use App\Http\Controllers\Admin\AdminProdi\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [HomeController::class, 'index'])->name('admin_prodi.dashboard');
