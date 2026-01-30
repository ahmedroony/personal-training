<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CaptainController;
route::get('/captain', [CaptainController::class, 'index'])->name('captain.index');
route::get('/captain/create', [CaptainController::class, 'create'])->name('captain.create');
route::post('/captain', [CaptainController::class, 'store'])->name('captain.store');
