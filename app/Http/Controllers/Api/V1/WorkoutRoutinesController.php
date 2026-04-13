<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\admin\Actions\WorkoutRoutinesService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutRoutinesController extends Controller
{
    protected $workoutService;

    public function __construct(WorkoutRoutinesService $workoutService)
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $this->workoutService->updateDescription($validated);
        
        return response()->json([
            'status' => true,
            'message' => 'تم حفظ الجدول بنجاح',
        ], 200);
    }
}
