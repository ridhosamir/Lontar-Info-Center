<?php

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

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admins.dashboard-admin');
    })->name('admins.dashboard');

    Route::get('/admin/manage-reminder', function () {
        return view('admins.manage-reminder');
    })->name('admins.manage-reminder');

    Route::get('/admin/manage-poster', function () {
        return view('admins.manage-poster');
    })->name('admins.manage-poster');

    Route::resource('portal-admin', PortalAdminController::class)->names([
        'index' => 'admins.portal-admin',
        'create' => 'admins.portal-admin.create',
        'store' => 'admins.portal-admin.store',
        'show' => 'admins.portal-admin.show',
        'edit' => 'admins.portal-admin.edit',
        'update' => 'admins.portal-admin.update',
        'destroy' => 'admins.portal-admin.destroy'
    ]);

    Route::resource('portal-utama', PortalUtamaController::class)->names([
        'index' => 'admins.portal-utama',
        'create' => 'admins.portal-utama.create',
        'store' => 'admins.portal-utama.store',
        'show' => 'admins.portal-utama.show',
        'edit' => 'admins.portal-utama.edit',
        'update' => 'admins.portal-utama.update',
        'destroy' => 'admins.portal-utama.destroy'
    ]);

    Route::resource('reminder', ReminderController::class);
    Route::resource('poster', PosterController::class);
});