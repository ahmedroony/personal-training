<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CaptainController;
route::get('/captain', [CaptainController::class, 'index'])->name('captain.index');
route::get('/captain/create', [CaptainController::class, 'create'])->name('captain.create');
route::put('/captain/update/{id}', [CaptainController::class, 'update'])->name('captain.update');
route::post('/captain', [CaptainController::class, 'store'])->name('captain.store');
route::get('/captain/edit', [CaptainController::class, 'editpage'])->name('page.edit');
route::get('/captain/edit/{id}', [CaptainController::class, 'edit'])->name('captain.edit');
Route::post('/captain/toggle-status/{id}', [CaptainController::class, 'toggleStatus'])->name('captain.toggleStatus');
//************************************************************************************************************** */
