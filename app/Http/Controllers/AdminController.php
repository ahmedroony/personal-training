<?php

namespace App\Http\Controllers;

use App\interfaces\AdminServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $data = $this->adminService->getDashboardData();

        return view('admin.index', $data);
    }

    public function createClient()
    {
        $plans = $this->adminService->getAllPlans();

        return view('clients.create', compact('plans'));
    }

    public function manage()
    {
        $users = $this->adminService->getAllClients();

        return view('clients.index', compact('users'));
    }

    public function storeClient(StoreClientRequest $request)
    {
        $validatedData = $request->validated();
        $this->adminService->storeClient($validatedData);
        return redirect()->route('admin.manage')->with('success', 'تم إضافة المتدرب بنجاح.');
    }

    public function editClient($id)
    {
        $user = $this->adminService->editClient($id);
        $plans = $this->adminService->getAllPlans();

        return view('clients.edit', compact('user', 'plans'));
    }

    public function updateClient(UpdateClientRequest $request,$id)
    {
        $validatedData = $request->validated();
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

        return view('clients.show', compact('user'));
    }

    public function attendance()
    {
        $users = $this->adminService->getClientsWithAttendance();

        return view('admin.attendance', compact('users'));
    }

    public function storeAttendance($subscription_id)
    {
        $this->adminService->storeAttendance($subscription_id);

        return redirect()->back()->with('success', 'تم تسجيل الحضور بنجاح!');
    }

    public function captainAttendance()
    {
        $data = $this->adminService->getCaptainAttendanceData();

        return view('captains.admin_panel.attendance', $data);
    }
}
