<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PortalAdminController;
use App\Http\Controllers\PortalUtamaController;
use App\Http\Controllers\PosterController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PortalController;

use App\Http\Controllers\DashboardAdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome page with portal cards
Route::get('/', [WelcomeController::class, 'index']);

// Portal click tracking
Route::get('/portal/click/{id}', [PortalController::class, 'click'])->name('portal.click');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


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
=======
// Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admins.')->group(function () {
    // Route Dashboard Admin
    Route::get('/dashboard', [DashboardAdminController::class, 'showDashboard'])->name('dashboard-admin');

    // Route Portal Admin
    Route::resource('portal-admin', PortalAdminController::class)->names([
        'index' => 'portal-admin',
        'create' => 'portal-admin.create',
        'store' => 'portal-admin.store',
        'show' => 'portal-admin.show',
        'edit' => 'portal-admin.edit',
        'update' => 'portal-admin.update',
        'destroy' => 'portal-admin.destroy'
    ]);

    // Route Portal Utama
    Route::resource('portal-utama', PortalUtamaController::class)->names([
        'index' => 'portal-utama',
        'create' => 'portal-utama.create',
        'store' => 'portal-utama.store',
        'show' => 'portal-utama.show',
        'edit' => 'portal-utama.edit',
        'update' => 'portal-utama.update',
        'destroy' => 'portal-utama.destroy'
    ]);

    // Route Manage Reminder
    Route::get('/manage-reminder', [ReminderController::class, 'index'])->name('manage-reminder');
    Route::put('/reminder/{reminder}', [ReminderController::class, 'update'])->name('reminder.update');

    // Route Manage Poster
    Route::get('/manage-poster', [PosterController::class, 'index'])->name('manage-poster');
    Route::post('/manage-poster', [PosterController::class, 'store'])->name('manage-poster.store');
    Route::get('/posters/all', [PosterController::class, 'getAllPosters'])->name('posters.all');
    Route::delete('/poster/delete-multiple', [PosterController::class, 'destroyMultiple'])->name('poster.destroyMultiple');
    Route::resource('poster', PosterController::class)->except(['index', 'store']);

});