<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PortalAdminController;
use App\Http\Controllers\PortalUtamaController;
use App\Http\Controllers\PosterController;

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

// // Admin Routes - Pastikan route ini terdaftar dengan benar
// Route::get('/admin/dashboard', function () {
//     return view('admins.dashboard-admin');
// })->name('admins.dashboard')->middleware('auth');

// Alternatif cara mendefinisikan route
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admins.dashboard-admin');
    })->name('admins.dashboard');

    Route::get('/admin/portal-admin', function () {
        return view('admins.portal-admin');
    })->name('admins.portal-admin');

    Route::get('/admin/portal-utama', function () {
        return view('admins.portal-utama');
    })->name('admins.portal-utama');

    Route::get('/admin/manage-reminder', function () {
        return view('admins.manage-reminder');
    })->name('admins.manage-reminder');

    Route::get('/admin/manage-poster', function () {
        return view('admins.manage-poster');
    })->name('admins.manage-poster');

    Route::resource('reminder', ReminderController::class);
    Route::resource('portal-admin', PortalAdminController::class);
    Route::resource('portal-utama', PortalUtamaController::class);
    Route::resource('poster', PosterController::class);
});