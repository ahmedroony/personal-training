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
    public function createClient()
    {
        return view('admin.create_client');
    }
    public function mange()
    {
        return view('admin.mange');
    }
    public function storeClient(Request $request, AdminService $adminService)
    {
        $adminService->storeClient($request);
        return redirect()->route('admin.mange')->with('success', 'Client created successfully.');
    }
}
