<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/dashboard', [HomeController::class, 'dashboard_superuser'])->name('super_admin.dashboard');
