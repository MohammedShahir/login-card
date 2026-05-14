<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\StoreController;

Route::get('/', [StoreController::class, 'index'])->name('store.index');

Route::middleware(['hotspot'])->group(function () {
    Route::get('/hotspot/login', [HotspotController::class, 'showLogin'])->name('hotspot.login');
});

use App\Http\Controllers\Admin\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('resellers', \App\Http\Controllers\Admin\ResellerController::class);
    Route::resource('plans', \App\Http\Controllers\Admin\PlanController::class);
    Route::get('mikrotik', [\App\Http\Controllers\Admin\MikrotikConfigController::class, 'edit'])->name('mikrotik.edit');
    Route::post('mikrotik', [\App\Http\Controllers\Admin\MikrotikConfigController::class, 'update'])->name('mikrotik.update');
});
