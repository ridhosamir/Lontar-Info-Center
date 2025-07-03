<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - Pastikan route ini terdaftar dengan benar
Route::get('/admin/dashboard', function () {
    return view('admins.dashboard-admin');
})->name('admin.dashboard')->middleware('auth');

// Alternatif cara mendefinisikan route
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard-admin');
//     })->name('admin.dashboard');
// });