<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function () {

    Route::put('upload-report/{id}', [ActivityController::class, 'uploadFileActivity'])
        ->name('activity.report_file');

});
