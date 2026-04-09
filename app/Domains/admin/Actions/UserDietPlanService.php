<?php
namespace App\Domains\admin\Actions;
use App\Models\User;
use App\Models\DietPlan;
use App\Models\Diet;
use App\interfaces\UserDietPlanServiceInterface;

class UserDietPlanService implements UserDietPlanServiceInterface{
    public function index()
    {
        $users = User::whereHas('subscription', function($q) {
            $q->where('end_date', '>=', now());
        })->with('subscription')->get();

        $dietPlans = DietPlan::all();

        return compact('users', 'dietPlans');
    }

    public function store(array $data)
    {
        return Diet::create([
            'subscription_id' => $data['subscription_id'],
            'diet_plan_id' => $data['diet_plan_id'],
            'custom_notes' => $data['custom_notes'] ?? null,
        ]);
    }
}
