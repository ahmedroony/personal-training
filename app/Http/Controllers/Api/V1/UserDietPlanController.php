<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domains\admin\Actions\UesrDietPlanService;
use Illuminate\Http\Request;

class UserDietPlanController extends Controller
{
    protected $UesrDiet;

    public function __construct(UesrDietPlanService $UesrDiet)
    {
        $this->UesrDiet = $UesrDiet;
    }

    public function index()
    {
        $data = $this->UesrDiet->index();
        
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

        $this->UesrDiet->store($validated);

        return response()->json([
            'status' => true,
            'message' => 'تم تعيين النظام الغذائي بنجاح!',
        ], 200);
    }
}
