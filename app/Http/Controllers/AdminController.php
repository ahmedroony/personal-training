<?php

namespace App\Http\Controllers;

use App\Domains\admin\Actions\AdminService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        // نطلب البيانات الجاهزة من السيرفس بدل ما نعالجها هنا
        // الكنترولر وظيفته ياخد الداتا ويسلمها للـ View بس (SRP)
        $users = $this->adminService->getAllClients();

        return view('admin.index', compact('users'));
    }

    public function createClient()
    {
        return view('admin.create_client');
    }

    public function manage()
    {
        // بدل ما كنا بنعمل User::all() ونجلب كل حاجة حتى المديرين (Admins)
        // هنستخدم نفس الدالة اللي في السيرفس عشان نجيب المتدربين (العملاء) بس
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
    public function deleteClient($id)
    {
        $this->adminService->deleteClient($id);
        return redirect()->route('admin.index')->with('success', 'تم حذف المتدرب بنجاح.');
    }   
}
