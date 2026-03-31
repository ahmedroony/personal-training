<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\admin\Actions\CaptainService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    protected $captainService;

    public function __construct(CaptainService $captainService)
    {
        $this->captainService = $captainService;
    }

    public function index()
    {
        $captains = $this->captainService->getAllCaptains();

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات الكباتن بنجاح',
            'data' => [
                'captains' => $captains
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20|unique:phones,number',
        ], [
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً، يرجى اختيار بريد آخر.',
            'phone_number.unique' => 'رقم الهاتف مسجل مسبقاً، يرجى اختيار رقم آخر.',
        ]);

        $this->captainService->storeCaptain($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة الكابتن بنجاح!',
        ], 201);
    }

    public function show($id)
    {
        $captain = $this->captainService->getCaptainById($id);

        if (!$captain) {
            return response()->json([
                'status' => false,
                'message' => 'الكابتن غير موجود.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات الكابتن بنجاح',
            'data' => [
                'captain' => $captain
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'nullable|string|max:20|unique:phones,number,' . $id . ',user_id',
            'password' => 'nullable|string|min:8',
        ]);

        $this->captainService->updateCaptain($id, $validatedData);

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات الكابتن بنجاح!',
        ], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->captainService->deleteCaptain($id);

        if ($deleted) {
            return response()->json([
                'status' => true,
                'message' => 'تم حذف الكابتن بنجاح!',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'حدث خطأ أثناء الحذف.',
        ], 500);
    }
}
