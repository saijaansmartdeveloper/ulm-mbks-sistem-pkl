<?php

use App\Http\Controllers\InternshipController;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')->group(function () {

    Route::put('upload-resport/{id}', [InternshipController::class, 'uploadInternship'])
        ->name('internship.report_file');

});
