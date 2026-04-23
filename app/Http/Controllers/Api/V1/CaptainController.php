<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\admin\Actions\CaptainService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaptainRequest;
use App\Http\Requests\UpdateCaptainRequest;
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

    public function store(StoreCaptainRequest $request)
    {
        $validatedData = $request->validated();

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

    public function update(UpdateCaptainRequest $request, $id)
    {
        $validatedData = $request->validated();

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
