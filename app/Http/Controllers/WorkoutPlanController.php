<?php

namespace App\Http\Controllers;

use App\interfaces\WorkoutPlanServiceInterface;
use App\Http\Requests\StoreWorkoutPlanRequest;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    protected $workout;

    public function __construct(WorkoutPlanServiceInterface $workout)
    {
        $this->workout = $workout;
    }

    public function index()
    {
        $users = $this->workout->index();
        return view('workout.index', compact('users'));
    }

    public function store(StoreWorkoutPlanRequest $request)
    {
        $validated = $request->validated();

        $this->workout->updateDescription($validated);
        return redirect()->route('workout-plan.index')->with('success', 'تم حفظ الجدول بنجاح');
    }
}
