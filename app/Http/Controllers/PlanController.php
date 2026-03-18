<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\admin\Actions\PlanService;

class PlanController extends Controller
{
    protected $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    // ───────── Diet Plans ─────────

    public function dietIndex()
    {
        $users = $this->planService->getClients();
        return view('diet_plans.index', compact('users'));
    }

    public function dietStore(Request $request)
    {
        $data = $request->all();
        $this->planService->storeDietPlan($data);
        return redirect()->route('diet_plans.index')->with('success', 'تم اضافة النظام الغذائي بنجاح');
    }
}
