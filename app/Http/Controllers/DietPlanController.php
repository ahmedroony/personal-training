<?php

namespace App\Http\Controllers;

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
        $users = $this->dietPlanService->index();
        return view('diet_plans.index', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->dietPlanService->store($data);
        return redirect()->route('diet_plans.index')->with('success', 'Diet Plan created successfully');
    }
}
