<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\admin\Actions\AdminService;
class AdminController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index()
    {
        $users = $this->adminService->index();
        return view('admin.index', ['users' => $users]);
    }
    public function createClient()
    {
        return view('admin.create_client');
    }
    public function manage()
    {
        return view('admin.manage');
    }
    public function storeClient(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'name_plan' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ]);
        $this->adminService->storeClient($validatedData);
        return redirect()->route('admin.index')->with('success', 'Client created successfully.');
    }
}
