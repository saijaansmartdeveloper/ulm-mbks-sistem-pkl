<?php

use App\Http\Controllers\Admin\SuperAdmin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->name('super_admin.dashboard');
