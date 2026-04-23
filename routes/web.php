<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Captain\CaptainController as CaptainDashboardController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserDietPlan;
use App\Http\Controllers\WorkoutPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'home'])->name('home');
// ----------------- مسارات الكابتن -----------------
Route::middleware(['auth', 'user_types:Captain'])->group(function () {
    Route::get('/captain/dashboard', [CaptainDashboardController::class, 'index'])->name('captain.dashboard');
    Route::post('/captain/add-client', [CaptainDashboardController::class, 'addClient'])->name('captain.addClient');
    Route::post('/captain/checkin', [CaptainDashboardController::class, 'checkIn'])->name('captain.checkin');
});
// --------------------------عملاء-------------------------------------
Route::middleware(['auth', 'user_types:Client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::post('/client/checkin', [ClientController::class, 'checkIn'])->name('client.checkin');
});
// -----------------  وأدمن -----------------
Route::middleware(['auth', 'user_types:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/manage', [AdminController::class, 'manage'])->name('admin.manage');
    Route::get('/admin/createclient', [AdminController::class, 'createClient'])->name('admin.createClient');
    Route::post('/admin/storeclient', [AdminController::class, 'storeClient'])->name('admin.storeClient');

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
    Route::get('/admin/workout-plans', [WorkoutPlanController::class, 'index'])->name('workout-plan.index');
    Route::post('/admin/workout-plans', [WorkoutPlanController::class, 'store'])->name('workout-plan.store');

    // ----------------- إنشاء الأنظمة -----------------
    Route::get('/admin/createmeal', [DietPlanController::class, 'index'])->name('create_diet_plans.index');
    Route::post('/admin/createmeal', [DietPlanController::class, 'store'])->name('create_diet_plans.store');

    // ----------------- تعيين الأنظمة -----------------
    Route::get('/admin/meals', [UserDietPlan::class, 'index'])->name('diet_plans.index');
    Route::post('/admin/meals', [UserDietPlan::class, 'store'])->name('diet_plans.store');
    // -----------------  settings -----------------
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::delete('/admin/settings/{id}', [SettingController::class, 'delete'])->name('setting.delete');
    Route::delete('/admin/settings/diet/{id}', [SettingController::class, 'deleteDietPlan'])->name('setting.diet.delete');
});

// --------------------------------------------------------------------------------------------
Route::get('/register', [AuthController::class, 'showRegistar'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
