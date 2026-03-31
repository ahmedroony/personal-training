<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\admin\Actions\workoutroutines;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutRoutinesController extends Controller
{
    protected $workout;

    public function __construct(workoutroutines $workout)
    {
        $this->workout = $workout;
    }

    public function index()
    {
        $users = $this->workout->index();
        
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

        $this->workout->updateDescription($validated);
        
        return response()->json([
            'status' => true,
            'message' => 'تم حفظ الجدول بنجاح',
        ], 200);
    }
}
