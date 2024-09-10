<?php

use App\Http\Controllers\AdminReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

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

    // =============== USER ============= \\
    Route::get('/reports/newest', [ReportController::class, 'getNewestReports'])->name('reports.newest');
    Route::get('/reports/popular/{timeFrame}', [ReportController::class, 'getPopularReports'])->name('reports.popular');
    Route::get('/reports/search', [ReportController::class, 'getReportByTitle'])->name('reports.search');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/posted', [ReportController::class, 'index'])->name('reports.posted');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports/create', [ReportController::class, 'store'])->name('reports.store');
    Route::post('/reports/{reportId}/rate', [ReportController::class, 'postReportRatings'])->name('post.report.rating');
    
    // =============== ADMIN ============= \\
    Route::middleware('CheckIsAdmin')->group(function () {
        Route::get('/reports/popular/{timeFrame}', [AdminReportController::class, 'getPopularReports'])->name('reports.popular');
        Route::get('/reports/{report}', [AdminReportController::class, 'show'])->name('reports.show');
        Route::get('/reports/search', [AdminReportController::class, 'getReportByTitle'])->name('reports.search');
        Route::delete('/admin/reports/{reportId}/delete', [AdminReportController::class, 'destroy'])->name('admin.report.delete');
        Route::put('/admin/reports/{report}/status', [AdminReportController::class, 'updateReportStatus'])->name('admin.reports.updateReportStatus');
    });
});

require __DIR__.'/auth.php';
