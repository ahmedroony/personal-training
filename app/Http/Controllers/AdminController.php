<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\admin\Actions\AdminService;
class AdminController extends Controller
{
    public function index(AdminService $adminService)
    {
        $users = $adminService->index();
        return view('admin.index', ['users' => $users]);
    }
    public function create()
    {
        return view('admin.create');
    }
    public function mange()
    {
        return view('admin.mange');
    }
}
