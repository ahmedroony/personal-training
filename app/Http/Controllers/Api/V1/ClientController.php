<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\admin\Actions\AdminService;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function store(Request $request)
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

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة المتدرب بنجاح',
        ], 201);
    }

    public function show(string $id)
    {
        $user = $this->adminService->getClientById($id);

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات المتدرب بنجاح',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }

    public function editClient(string $id)
    {
        $user = $this->adminService->editClient($id);
        $plans = Plan::all();

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات المتدرب والخطط بنجاح',
            'data' => [
                'user' => $user,
                'plans' => $plans
            ]
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|string|max:20|unique:phones,number,'.$id.',user_id',
            'plan_id' => 'required|exists:plans,id',
            'end_date' => 'nullable|date',
        ]);

        $this->adminService->updateClient($id, $validatedData);

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث بيانات المتدرب بنجاح',
        ], 200);
    }

    public function destroy(string $id)
    {
        $this->adminService->deleteClient($id);

        return response()->json([
            'status' => true,
            'message' => 'تم حذف المتدرب بنجاح',
        ], 200);
    }
}
