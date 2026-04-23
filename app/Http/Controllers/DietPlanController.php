<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDietPlanRequest;
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
        $dietPlans =  $this->dietPlanService->index();
        return view('diet_plans.create', compact('dietPlans'));
    }

    public function store(StoreDietPlanRequest $request){
        $vaildata = $request->validated();
        $this->dietPlanService->store($vaildata);
        return redirect()->route('create_diet_plans.index')->with('success', 'تم إضافة الخطة بنجاح');
    }
}
