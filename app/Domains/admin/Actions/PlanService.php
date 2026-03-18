<?php

namespace App\Domains\admin\Actions;

use App\Models\User;
use App\Models\DietPlan;

class PlanService
{
    /**
     * Get all clients with their subscriptions.
     */
    public function getClients()
    {
        return User::whereHas('userType', function($q) {
            $q->where('name', 'Client');
        })->with('subscription.plan')->get();
    }

    /**
     * Store a diet plan for a user.
     */
    public function storeDietPlan(array $data)
    {
        $user = User::findOrFail($data['user_id']);
        return $user->dietPlans()->create([
            'description' => $data['description'] ?? 'no description',
        ]);
    }
}
