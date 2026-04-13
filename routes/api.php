<?php

use App\Http\Controllers\Api\V1\AdminDashboardController;
use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\CaptainController;
use App\Http\Controllers\Api\V1\CaptainDashboardController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\DietPlanController;
use App\Http\Controllers\Api\V1\UserDietPlanController;
use App\Http\Controllers\Api\V1\WorkoutRoutinesController;
use App\Models\Plan;
use App\Http\Controllers\Api\AuthapiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ----------------- المصادقة (Auth) -----------------
Route::post('/login', [AuthapiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthapiController::class, 'logout']);

    // ----------------- عملاء وأدمن -----------------
    Route::get('/admin', [AdminDashboardController::class, 'index']);
    Route::post('/admin/storeclient', [ClientController::class, 'store']);
    Route::get('/admin/client/{id}', [ClientController::class, 'show']);
    Route::get('/admin/editclient/{id}', [ClientController::class, 'editClient']);
    Route::put('/admin/updateclient/{id}', [ClientController::class, 'update']);
    Route::delete('/admin/deleteclient/{id}', [ClientController::class, 'destroy']);

    Route::get('/admin/attendance', [AttendanceController::class, 'attendance']);
    Route::post('/admin/attendance/{subscription_id}', [AttendanceController::class, 'storeAttendance']);
    Route::get('/admin/captains/attendance', [AttendanceController::class, 'captainAttendance']);

    // ----------------- كباتن (إدارة المدير) -----------------
    Route::get('/admin/captains', [CaptainController::class, 'index']);
    Route::post('/admin/captains/store', [CaptainController::class, 'store']);
    Route::get('/admin/captains/{id}', [CaptainController::class, 'show']);
    Route::put('/admin/captains/{id}', [CaptainController::class, 'update']);
    Route::delete('/admin/captains/{id}', [CaptainController::class, 'destroy']);

    // ----------------- جداول التمارين -----------------
    Route::get('/admin/workoutroutines', [WorkoutRoutinesController::class, 'index']);
    Route::post('/admin/workoutroutines', [WorkoutRoutinesController::class, 'store']);

    // ----------------- إنشاء الأنظمة الغذائية -----------------
    Route::get('/admin/createmeal', [DietPlanController::class, 'index']);
    Route::post('/admin/createmeal', [DietPlanController::class, 'store']);

    // ----------------- تعيين الأنظمة الغذائية للمتدربين -----------------
    Route::get('/admin/meals', [UserDietPlanController::class, 'index']);
    Route::post('/admin/meals', [UserDietPlanController::class, 'store']);

    // ----------------- مسارات الكابتن (لوحة التحكم الخاصة بالكابتن) -----------------
    Route::get('/captain/dashboard', [CaptainDashboardController::class, 'index']);
    Route::post('/captain/checkin', [CaptainDashboardController::class, 'checkIn']);
});

// ----------------- عام -----------------
Route::get('/plans', function () {
    return response()->json([
        'plans' => Plan::paginate(10),
    ]);
});
