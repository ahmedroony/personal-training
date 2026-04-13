<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domains\admin\Actions\UserDietPlanService;
use Illuminate\Http\Request;

class UserDietPlanController extends Controller
{
    protected $userDietService;

    public function __construct(UserDietPlanService $userDietService)
    {
        $this->userDietService = $userDietService;
    }

    public function index()
    {
        $data = $this->userDietService->index();
        
        return response()->json([
            'status' => true,
            'message' => 'تم جلب خطط وتعيينات الأنظمة الغذائية بنجاح',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'diet_plan_id' => 'required|exists:diet_plans,id',
            'custom_notes' => 'nullable|string',
        ]);

        $this->userDietService->store($validated);

        return response()->json([
            'status' => true,
            'message' => 'تم تعيين النظام الغذائي بنجاح!',
        ], 200);
    }
}
