<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\WorkoutRoutinesController;
use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\UserDietPlan;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Captain\CaptainController as CaptainDashboardController;
use Illuminate\Support\Facades\Route;

// ----------------- الصفحة الرئيسية -----------------
Route::get('/', [ClientController::class, 'home'])->name('home');

// ----------------- مسارات الكابتن -----------------
Route::middleware(['auth'])->group(function () {
    Route::get('/captain/dashboard', [CaptainDashboardController::class, 'index'])->name('captain.dashboard');
    Route::post('/captain/checkin', [CaptainDashboardController::class, 'checkIn'])->name('captain.checkin');
});

// ----------------- عملاء وأدمن -----------------
Route::middleware(['auth'])->group(function () {
    // لوحة تحكم المتدرب
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/manage', [AdminController::class, 'manage'])->name('admin.manage');
    Route::get('/admin/createclient', [AdminController::class, 'createclient'])->name('admin.createclient');
    Route::post('/admin/storeclient', [AdminController::class, 'storeclient'])->name('admin.storeclient');

    Route::get('/admin/editClient/{id}', [AdminController::class, 'editClient'])->name('admin.editClient');
    Route::put('/admin/updateClient/{id}', [AdminController::class, 'updateClient'])->name('admin.updateClient');
    Route::delete('/admin/deleteClient/{id}', [AdminController::class, 'deleteClient'])->name('admin.deleteClient');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/client/{id}', [AdminController::class, 'showClient'])->name('admin.client.show');
    Route::get('/admin/attendance', [AdminController::class, 'attendance'])->name('admin.attendance');
    Route::get('/admin/captains/attendance', [AdminController::class, 'captainAttendance'])->name('admin.captains.attendance');
    Route::post('/admin/attendance/{subscription_id}', [AdminController::class, 'storeAttendance'])->name('admin.attendance.store');

    // ----------------- كباتن (إدارة المدير) -----------------
    Route::get('/admin/captains', [CaptainController::class, 'index'])->name('admin.captains.index');
    Route::get('/admin/captains/create', [CaptainController::class, 'create'])->name('admin.captains.create');
    Route::post('/admin/captains/store', [CaptainController::class, 'store'])->name('admin.captains.store');
    Route::get('/admin/captains/{id}/edit', [CaptainController::class, 'edit'])->name('admin.captains.edit');
    Route::put('/admin/captains/{id}', [CaptainController::class, 'update'])->name('admin.captains.update');
    Route::delete('/admin/captains/{id}', [CaptainController::class, 'destroy'])->name('admin.captains.destroy');

    // ----------------- جداول التمارين -----------------
    Route::get('/admin/workoutroutines', [WorkoutRoutinesController::class, 'index'])->name('workout.index');
    Route::post('/admin/workoutroutines', [WorkoutRoutinesController::class, 'store'])->name('workout.store');

    // ----------------- إنشاء الأنظمة -----------------
    Route::get('/admin/createmeal', [DietPlanController::class, 'index'])->name('create_diet_plans.index');
    Route::post('/admin/createmeal', [DietPlanController::class, 'store'])->name('create_diet_plans.store');

    // ----------------- تعيين الأنظمة -----------------
    Route::get('/admin/meals', [UserDietPlan::class, 'index'])->name('diet_plans.index');
    Route::post('/admin/meals', [UserDietPlan::class, 'store'])->name('diet_plans.store');
});

// --------------------------------------------------------------------------------------------
Route::get('/register', [AuthController::class, 'showRegistar'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
