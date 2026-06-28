<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public listener homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/cabin', [AdminController::class, 'updateCabin'])->name('cabin.update');

    // News CRUD
    Route::get('/news', [AdminController::class, 'newsIndex'])->name('news.index');
    Route::get('/news/create', [AdminController::class, 'newsCreate'])->name('news.create');
    Route::post('/news', [AdminController::class, 'newsStore'])->name('news.store');
    Route::get('/news/{news}/edit', [AdminController::class, 'newsEdit'])->name('news.edit');
    Route::post('/news/{news}', [AdminController::class, 'newsUpdate'])->name('news.update');
    Route::delete('/news/{news}', [AdminController::class, 'newsDestroy'])->name('news.destroy');

    // Daily Gospel CRUD
    Route::get('/gospels', [AdminController::class, 'gospelsIndex'])->name('gospels.index');
    Route::get('/gospels/create', [AdminController::class, 'gospelsCreate'])->name('gospels.create');
    Route::post('/gospels', [AdminController::class, 'gospelsStore'])->name('gospels.store');
    Route::get('/gospels/{gospel}/edit', [AdminController::class, 'gospelsEdit'])->name('gospels.edit');
    Route::post('/gospels/{gospel}', [AdminController::class, 'gospelsUpdate'])->name('gospels.update');
    Route::delete('/gospels/{gospel}', [AdminController::class, 'gospelsDestroy'])->name('gospels.destroy');

    // Weekly Schedule CRUD
    Route::get('/schedules', [AdminController::class, 'schedulesIndex'])->name('schedules.index');
    Route::get('/schedules/create', [AdminController::class, 'schedulesCreate'])->name('schedules.create');
    Route::post('/schedules', [AdminController::class, 'schedulesStore'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [AdminController::class, 'schedulesEdit'])->name('schedules.edit');
    Route::post('/schedules/{schedule}', [AdminController::class, 'schedulesUpdate'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [AdminController::class, 'schedulesDestroy'])->name('schedules.destroy');

    // Sponsors CRUD
    Route::get('/sponsors', [AdminController::class, 'sponsorsIndex'])->name('sponsors.index');
    Route::get('/sponsors/create', [AdminController::class, 'sponsorsCreate'])->name('sponsors.create');
    Route::post('/sponsors', [AdminController::class, 'sponsorsStore'])->name('sponsors.store');
    Route::get('/sponsors/{sponsor}/edit', [AdminController::class, 'sponsorsEdit'])->name('sponsors.edit');
    Route::post('/sponsors/{sponsor}', [AdminController::class, 'sponsorsUpdate'])->name('sponsors.update');
    Route::delete('/sponsors/{sponsor}', [AdminController::class, 'sponsorsDestroy'])->name('sponsors.destroy');
});
