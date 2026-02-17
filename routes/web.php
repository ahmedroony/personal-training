<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
route::get('/admin/mange', [AdminController::class, 'mange'])->name('admin.mange');
route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
//--------------------------------------------------------------------------------------------
route::get('/register',[AuthController::class, 'showRegistar'])->name('show.register');
route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
