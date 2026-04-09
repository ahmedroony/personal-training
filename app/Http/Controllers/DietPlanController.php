<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\interfaces\DietPlanServiceInterface;

class DietPlanController extends Controller
{
    protected $dietPlanService;
    public function __construct(DietPlanServiceInterface $dietPlanService)
    {
        $this->dietPlanService = $dietPlanService;
    }
    public function index(){
        $users =  $this->dietPlanService->index();
        return view('diet_plans.create', compact('users'));
    }

    public function store(Request $request){
        $vaildata = $request->validate([
            'name' => 'required|string|max:255',
            'base_description' => 'required|string|max:255',
        ]);
        $this->dietPlanService->store($vaildata);
        return redirect()->route('create_diet_plans.store')->with('success', 'تم إضافة الخطة بنجاح');
    }
}
