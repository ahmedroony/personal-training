<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\WorkoutRoutinesController;
use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\UserDietPlan;
use Illuminate\Support\Facades\Route;

// ----------------- عملاء -----------------
route::middleware(['auth'])->group(function () {
    route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    route::get('/admin/manage', [AdminController::class, 'manage'])->name('admin.manage');
    route::get('/admin/createclient', [AdminController::class, 'createclient'])->name('admin.createclient');
    route::post('/admin/storeclient', [AdminController::class, 'storeclient'])->name('admin.storeclient');

    route::get('/admin/editClient/{id}', [AdminController::class, 'editClient'])->name('admin.editClient');
    route::put('/admin/updateClient/{id}', [AdminController::class, 'updateClient'])->name('admin.updateClient');
    route::delete('/admin/deleteClient/{id}', [AdminController::class, 'deleteClient'])->name('admin.deleteClient');
    route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    route::get('/admin/client/{id}', [AdminController::class, 'showClient'])->name('admin.client.show');
    route::get('/admin/attendance', [AdminController::class, 'attendance'])->name('admin.attendance');
    route::post('/admin/attendance/{subscription_id}', [AdminController::class, 'storeAttendance'])->name('admin.attendance.store');
    // ----------------- كباتن -----------------

    route::get('/admin/captains', [CaptainController::class, 'index'])->name('admin.captains.index');
    route::get('/admin/captains/create', [CaptainController::class, 'create'])->name('admin.captains.create');
    route::post('/admin/captains/store', [CaptainController::class, 'store'])->name('admin.captains.store');
    route::get('/admin/captains/{id}/edit', [CaptainController::class, 'edit'])->name('admin.captains.edit');
    route::put('/admin/captains/{id}', [CaptainController::class, 'update'])->name('admin.captains.update');
    route::delete('/admin/captains/{id}', [CaptainController::class, 'destroy'])->name('admin.captains.destroy');
    // ----------------- جداول التمارين -----------------
    route::get('/admin/workoutroutines', [WorkoutRoutinesController::class, 'index'])->name('workout.index');
    route::post('/admin/workoutroutines', [WorkoutRoutinesController::class, 'store'])->name('workout.store');
    // ----------------- عمل الانظمه-----------------
    route::get('/admin/createmeal' ,[DietPlanController::class,'index'])->name('create_diet_plans.index');
    route::post('/admin/createmeal' ,[DietPlanController::class,'store'])->name('create_diet_plans.store');
    // ----------------- الانظمه  -----------------
    route::get('/admin/meals', [UserDietPlan::class, 'index'])->name('diet_plans.index');
    route::post('/admin/meals', [UserDietPlan::class, 'store'])->name('diet_plans.store');
    // ----------------- كتالوج الأكل  -----------------
    route::get('/admin/foods', [FoodsController::class, 'index'])->name('foods.index');
    route::post('/admin/foods', [FoodsController::class, 'store'])->name('foods.store');
});
// --------------------------------------------------------------------------------------------
route::get('/register', [AuthController::class, 'showRegistar'])->name('show.register');
route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
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
