<?php

namespace App\Http\Controllers;
use App\interfaces\UserDietPlanServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDietPlan extends Controller
{
    protected $UesrDiet;
    public function __construct(UserDietPlanServiceInterface $UesrDiet)
    {
        $this->UesrDiet = $UesrDiet;
    }
    public function index(){
        $data = $this->UesrDiet->index();
        return view('diet_plans.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'diet_plan_id' => 'required|exists:diet_plans,id',
            'custom_notes' => 'nullable|string',
        ]);

        $this->UesrDiet->store($validated);

        return redirect()->back()->with('success', 'تم تعيين النظام الغذائي بنجاح!');
    }
}
