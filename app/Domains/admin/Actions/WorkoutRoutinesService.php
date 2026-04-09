<?php

namespace App\Domains\admin\Actions;

use App\Models\User;
use App\interfaces\WorkoutRoutinesServiceInterface;

class WorkoutRoutinesService implements WorkoutRoutinesServiceInterface
{
    public function index()
    {
        $users = User::whereHas('userType', function($q) {
            $q->where('name', 'Client');
        })->with('subscription.plan')->get();

        return $users;
    }

    public function updateDescription(array $data)
    {
        $user = User::with('subscription.plan')->findOrFail($data['user_id']);
        $subscription = $user->subscription;

        if ($subscription && $subscription->plan) {
            $subscription->plan->update([
                'description' => $data['description'] ?? 'no description',
            ]);
        }
    }
}
