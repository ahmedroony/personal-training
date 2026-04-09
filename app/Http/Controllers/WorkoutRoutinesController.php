<?php

namespace App\Http\Controllers;

use App\interfaces\WorkoutRoutinesServiceInterface;
use Illuminate\Http\Request;

class WorkoutRoutinesController extends Controller
{
    protected $workout;

    public function __construct(WorkoutRoutinesServiceInterface $workout)
    {
        $this->workout = $workout;
    }

    public function index()
    {
        $users = $this->workout->index();
        return view('workout.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $this->workout->updateDescription($validated);
        return redirect()->route('workout.index')->with('success', 'تم حفظ الجدول بنجاح');
    }
}
