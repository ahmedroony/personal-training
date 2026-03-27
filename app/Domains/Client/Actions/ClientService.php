<?php

namespace App\Domains\Client\Actions;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ClientService
{
    public function getDashboardData()
    {
        $user = Auth::user();

        if (!$user) return null;

        return User::with([
            'subscription.plan',
            'subscription.attendances' => function($query) {
                $query->latest();
            },
            'subscription.diets.dietPlan'
        ])->find($user->id);
    }
}
