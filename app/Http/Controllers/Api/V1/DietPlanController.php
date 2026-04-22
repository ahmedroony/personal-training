<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDietPlanRequest;
use Illuminate\Http\Request;
use App\Domains\admin\Actions\DietPlanService;

class DietPlanController extends Controller
{
    protected $dietPlanService;

    public function __construct(DietPlanService $dietPlanService)
    {
        $this->dietPlanService = $dietPlanService;
    }

    public function index()
    {
        $plans = $this->dietPlanService->index();
        
        return response()->json([
            'status' => true,
            'message' => 'تم جلب الأنظمة الغذائية بنجاح',
            'data' => [
                'plans' => $plans
            ]
        ], 200);
    }

    public function store(StoreDietPlanRequest $request)
    {
        $vaildata = $request->validated();
        
        $this->dietPlanService->store($vaildata);
        
        return response()->json([
            'status' => true,
            'message' => 'تم إضافة الخطة بنجاح',
        ], 201);
    }
}
