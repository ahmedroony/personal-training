<?php

namespace App\Http\Controllers;

use App\Domains\admin\Actions\AdminService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Subscription;
class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $users = $this->adminService->getAllClients();
        $usersCount = $users->count();
        $activeSubscribersCount = $users->where('current_status', 'active')->count();
        $inactiveSubscribersCount = $users->where('current_status', 'inactive')->count();
        return view('admin.index', compact('users','usersCount','activeSubscribersCount', 'inactiveSubscribersCount'));
    }

    public function createClient()
    {
        return view('admin.create_client');
    }

    public function manage()
    {
        $users = $this->adminService->getAllClients();
        return view('admin.manage',compact('users'));
    }

    public function storeClient(Request $request)
    {
        // 1. الفاليديشن (Validation) ده عادي يفضل في الكنترولر في المشاريع الصغيرة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'name_plan' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone_number',
            'starts_at' => 'required|date',
            'duration' => 'required|integer',
        ]);
        $this->adminService->storeClient($validatedData);
        return redirect()->route('admin.index')->with('success', 'تم إضافة المتدرب بنجاح.');
    }
    public function editClient($id)
    {
        $user = $this->adminService->editClient($id);
        return view('admin.edit_Client', compact('user'));
    }
    public function updateClient($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:20|unique:users,phone_number,' . $id,
            'name_plan' => 'required|string|max:255',
            'duration' => 'required|integer',
        ]);
        $this->adminService->updateClient($id, $validatedData);
        return redirect()->route('admin.index')->with('success', 'تم تحديث بيانات المتدرب بنجاح.');
    }
    public function deleteClient($id)
    {
        $this->adminService->deleteClient($id);
        return redirect()->route('admin.index')->with('success', 'تم حذف المتدرب بنجاح.');
    }
}
