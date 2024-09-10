<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reports/popular/{timeFrame}', [ReportController::class, 'getPopularReports'])->name('reports.popular');
    Route::get('/admin/reports/posted', [AdminReportController::class, 'getPostedReports'])->name('admin.reports.getPostedReports');
    // Admin routes
    Route::middleware('CheckIsAdmin')->group(function () {
        Route::get('/admin/reports/popular/{timeFrame}', [AdminReportController::class, 'getPopularReports'])->name('admin.reports.popular');
        Route::put('/admin/reports/{report}/status', [AdminReportController::class, 'updateReportStatus'])->name('admin.reports.updateReportStatus');
    });
});

require __DIR__.'/auth.php';
