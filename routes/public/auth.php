<?php

use App\Http\Controllers\Auth\AnotherUser\LoginController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'auth.'
], function () {
    Route::get('/login/{string?}', [LoginController::class, 'showFormLogin'])
        ->name('login')
        ->middleware(['guest:lecturer,student,partner']);
    Route::post('/login', [LoginController::class, 'doLogin'])
        ->name('doLogin')
        ->middleware(['guest:lecturer,student,partner']);
    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
