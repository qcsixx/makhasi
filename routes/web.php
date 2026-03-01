<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ActivityLogController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', [HomeController::class, 'home']);
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
});
Route::get('/makanan/{id}', [MenuController::class, 'show'])->name('detail');
Route::get('/about', [AboutController::class, 'about']);
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Library Routes - Available to all authenticated users
    Route::get('/library', [LibraryController::class, 'index'])->name('library');
    Route::post('/library/add', [LibraryController::class, 'addToLibrary'])->name('library.add');
    Route::delete('/library/{makananId}', [LibraryController::class, 'removeFromLibrary'])->name('library.remove');

    // Rating Routes - Available to all authenticated users
    Route::post('/ratings', [\App\Http\Controllers\RatingController::class, 'store'])->name('ratings.store');
    Route::delete('/ratings/{id}', [\App\Http\Controllers\RatingController::class, 'destroy'])->name('ratings.destroy');
});

// Admin Routes - Only accessible by admin users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes - Protected by auth and admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Food Management
    Route::prefix('food')->name('food.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::get('/{id}', [AdminController::class, 'show'])->name('show');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [AdminController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show', 'create', 'edit']);

    // Activity Logs Route
    Route::resource('activity-logs', ActivityLogController::class)->only(['index']);

    // Activity Log
    Route::get('/activity-log', [AdminController::class, 'activityLog'])->name('activity-log');

    // General Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

    // Admin Profile
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Legacy admin routes (keep for backward compatibility, will redirect)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/feed', function () {
        return redirect()->route('admin.food.index');
    })->name('feed');

    Route::get('/admin', function () {
        return redirect()->route('admin.food.create');
    })->name('admin');

    Route::post('/add', function () {
        return redirect()->route('admin.food.store');
    })->name('add');

    Route::get('/edit/{id}', function ($id) {
        return redirect()->route('admin.food.edit', $id);
    })->name('edit');

    Route::put('/update/{id}', function ($id) {
        return redirect()->route('admin.food.update', $id);
    })->name('update');

    Route::delete('/delete/{id}', function ($id) {
        return redirect()->route('admin.food.destroy', $id);
    })->name('delete');
    Route::delete('/makanan/{id}', function ($id) { // This was originally `[AdminController::class, 'delete']`
        return redirect()->route('admin.food.destroy', $id);
    })->name('makanan.delete');
});
