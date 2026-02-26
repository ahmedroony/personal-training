<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptainController;

route::middleware(['auth'])->group(function () {
    route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    route::get('/admin/manage', [AdminController::class, 'manage'])->name('admin.manage');
    route::get('/admin/createclient', [AdminController::class, 'createclient'])->name('admin.createclient');
    route::post('/admin/storeclient', [AdminController::class, 'storeclient'])->name('admin.storeclient');

    route::get('/admin/editClient/{id}', [AdminController::class, 'editClient'])->name('admin.editClient');
    route::put('/admin/updateClient/{id}', [AdminController::class, 'updateClient'])->name('admin.updateClient');
    route::delete('/admin/deleteClient/{id}', [AdminController::class, 'deleteClient'])->name('admin.deleteClient');
    // ----------------- كباتن -----------------
    
    route::get('/admin/captains', [CaptainController::class, 'index'])->name('admin.captains.index');
    route::get('/admin/captains/create', [CaptainController::class, 'create'])->name('admin.captains.create');
    route::post('/admin/captains/store', [CaptainController::class, 'store'])->name('admin.captains.store');
    route::get('/admin/captains/{id}/edit', [CaptainController::class, 'edit'])->name('admin.captains.edit');
    route::put('/admin/captains/{id}', [CaptainController::class, 'update'])->name('admin.captains.update');
    route::delete('/admin/captains/{id}', [CaptainController::class, 'destroy'])->name('admin.captains.destroy');
});
//--------------------------------------------------------------------------------------------
route::get('/register',[AuthController::class, 'showRegistar'])->name('show.register');
route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/captain/dashboard', function () {
    return "<h1 style='text-align:center; margin-top:50px;'>أهلاً بك يا كابتن 哨</h1>";
});

// مسار مؤقت للمتدرب
Route::get('/client/dashboard', function () {
    return "<h1 style='text-align:center; margin-top:50px;'>مرحباً بك في لوحة المتدرب 🏋️‍♂️</h1>";
});
