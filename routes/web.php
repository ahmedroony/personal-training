<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Domains\admin\Actions\AdminService;
route::get('/admin', [AdminService::class, 'index'])->name('admin.index');
