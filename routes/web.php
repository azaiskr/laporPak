<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}) -> name('home');

Route::get('/forum', function () {
    return view('forum');
}) -> name('forum');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/lapor', function () {
        return view('lapor');
    }) -> name('lapor');
});

//Used for testing
// Route::get('/newlogin', function () {
//     return view('newlogin');
// })->name('newlogin');

// Used for testing
// Route::get('/lapor', function () {
//     return view('lapor');
// })->name('lapor');

require __DIR__.'/auth.php';
