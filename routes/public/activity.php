<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function () {

    Route::put('upload-report/{id}', [ActivityController::class, 'uploadFileActivity'])
        ->name('activity.report_file');

});

Route::prefix('guidance')->group(function () {
    Route::get('/{guard}', [ActivityController::class, 'guidance'])
        ->name('activity.guidance');

    Route::get('/{guard}/{id}', [ActivityController::class, 'show'])
        ->name('activity.show');
});
