<?php

namespace App\Domains\Settings\Actions;

use App\interfaces\SettingServiceInterface;
use App\Models\Plan;
use App\Models\DietPlan;

class SettingService implements SettingServiceInterface
{
    public function getAllPlans()
    {
        return Plan::all();
    }

    public function deletePlan(int $id)
    {
        $plan = Plan::findOrFail($id);
        if ($plan) {
            $plan->delete();
            return true;
        }
        return false;
    }

    public function getAllDietPlans()
    {
        return DietPlan::all();
    }

    public function deleteDietPlan(int $id)
    {
        $dietPlan = DietPlan::findOrFail($id);
        if ($dietPlan) {
            $dietPlan->delete();
            return true;
        }
        return false;
    }
}
