<?php

use App\Http\Controllers\Auth\AnotherUser\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('login/{string?}', [LoginController::class, 'showLoginForm'])
        ->name('fom_login');

    Route::post('login', [LoginController::class, 'login'])
        ->name('login');
});


