<?php

namespace App\Http\Controllers;

use App\Domains\admin\Actions\AdminService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Subscription;
use App\Models\Plan;
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
        $plans = Plan::all();
        return view('admin.create_client', compact('plans'));
    }

    public function manage()
    {
        $users = $this->adminService->getAllClients();
        return view('admin.manage',compact('users'));
    }

    public function storeClient(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20|unique:phones,number',
            'starts_at' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:starts_at',
            'plan_id' => 'nullable|exists:plans,id',
            'name_plan' => 'required_without:plan_id|nullable|string|max:255',
            'duration' => 'required_without:plan_id|nullable|integer',
            'price' => 'nullable|numeric|min:0',
        ]);
        $this->adminService->storeClient($validatedData);
        return redirect()->route('admin.manage')->with('success', 'تم إضافة المتدرب بنجاح.');
    }
    public function editClient($id)
    {
        $user = $this->adminService->editClient($id);
        $plans = Plan::all();
        return view('admin.edit_Client', compact('user', 'plans'));
    }
    public function updateClient($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:20|unique:phones,number,' . $id . ',user_id',
            'plan_id' => 'required|exists:plans,id',
            'end_date' => 'nullable|date',
        ]);
        $this->adminService->updateClient($id, $validatedData);
        return redirect()->route('admin.index')->with('success', 'تم تحديث بيانات المتدرب بنجاح.');
    }
    public function deleteClient($id)
    {
        $this->adminService->deleteClient($id);
        return redirect()->route('admin.manage')->with('success', 'تم حذف المتدرب بنجاح.');
    }

    public function showClient($id)
    {
        $user = $this->adminService->getClientById($id);
        return view('admin.client_details', compact('user'));
    }

    public function attendance()
    {
        // كود بسيط لإحضار كل العملاء مع آخر عملية حضور سجلت لكل واحد منهم
        $users = User::whereHas('userType', function ($query) {
            $query->where('name', 'Client');
        })->with(['subscription.attendances' => function($query) {
            $query->latest()->limit(1); // نحتاج فقط لآخر موعد حضور
        }])->get();

        return view('admin.attendance', compact('users'));
    }

    public function storeAttendance($subscription_id)
    {
        // نجد الاشتراك المطلوب أولاً
        $subscription = \App\Models\Subscription::findOrFail($subscription_id);

        // نقوم بإنشاء سجل حضور جديد في جدول الحضور المرتبط بهذا الاشتراك
        $subscription->attendances()->create([
            'date' => date('Y-m-d'), // تاريخ اليوم بصيغة واضحة
            'time' => date('H:i:s'), // الوقت الحالي بصيغة واضحة
        ]);

        return redirect()->back()->with('success', 'تم تسجيل الحضور بنجاح!');
    }
}
