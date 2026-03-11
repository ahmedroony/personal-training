<?php

namespace App\Domains\admin\Actions;

use App\Models\User;

class DietPlanService
{
    public function index()
    {
        $users = User::where('role', 2)->with('subscription')->get();

        return $users;
    }

    public function store(array $data)
    {
        $user = User::findOrFail($data['user_id']);
        return $user->dietPlans()->create([
            'description' => $data['description'] ?? 'no description',
        ]);
    }
}
