<?php

namespace App\Http\Controllers\Api\V1;

use App\interfaces\WorkoutPlanServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkoutPlanRequest;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    protected $workoutService;

    public function __construct(WorkoutPlanServiceInterface $workoutService)
    {
        $this->workoutService = $workoutService;
    }

    public function index()
    {
        $users = $this->workoutService->index();
        
        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات جداول التمارين بنجاح',
            'data' => [
                'users' => $users
            ]
        ], 200);
    }

    public function store(StoreWorkoutPlanRequest $request)
    {
        $validated = $request->validated();

        $this->workoutService->updateDescription($validated);
        
        return response()->json([
            'status' => true,
            'message' => 'تم حفظ الجدول بنجاح',
        ], 200);
    }
}
