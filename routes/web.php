<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {return view('home');});

Route::get('/home',[HomeController::class,'home']) ;
Route::get('/menu',[MenuController::class,'menu'])->name('menu');
Route::get('/makanan/{id}', [MenuController::class, 'show'])->name('detail');
Route::get('/about',[AboutController::class,'about']); ;
Route::get('/feed',[AdminController::class,'feed'])->name('feed');;
Route::get('/admin',[AdminController::class,'admin'])->name('admin');
Route::post('/add',[AdminController::class,'add'])->name('add');
Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
Route::put('/edit/{id}', [AdminController::class, 'update'])->name('update');
Route::delete('/feed/{id}', [AdminController::class, 'delete'])->name('delete');
Route::delete('/makanan/{id}', [AdminController::class, 'delete'])->name('makanan.delete');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
