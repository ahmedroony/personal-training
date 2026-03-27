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
    public function index(){
        $plans =  $this->dietPlanService->index();
        return view('diet_plans.createDietplan',compact('plans'));
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
