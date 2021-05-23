<?php

use App\Http\Controllers\Auth\AnotherUser\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user.'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])
        ->name('form_login');

    Route::post('login', [LoginController::class, 'authenticate'])
        ->name('login');
});


