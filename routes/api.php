<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiReportController;
use App\Http\Middleware\ApiKeyAuth;

Route::middleware([ApiKeyAuth::class])->group(function () {
    Route::get('/reports', [ApiReportController::class, 'index']);

    Route::get('/reports/{id}', [ApiReportController::class, 'show']);
});
