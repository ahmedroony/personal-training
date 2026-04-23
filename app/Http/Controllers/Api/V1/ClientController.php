<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\admin\Actions\AdminService;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validated();

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

    public function update(UpdateClientRequest $request, string $id)
    {
        $validatedData = $request->validated();

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
