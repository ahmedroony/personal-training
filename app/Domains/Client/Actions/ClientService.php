<?php

namespace App\Domains\Client\Actions;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ClientService
{
    public function getDashboardData()
    {
        $user = Auth::user();

        if (! $user) {
            return null;
        }

        return User::with([
            'subscription.plan',
            'subscription.attendances' => function ($query) {
                $query->latest();
                }
                ,
                'subscription.diets.dietPlan',])->find($user->id);
    }

    public function checkIn()
    {
        $user = Auth::user();
        if (! $user) {
            return false;
        }

        $subscription = Subscription::where('user_id', $user->id)
            ->latest()
            ->first();

        if (! $subscription || ! $subscription->is_active) {
            return false;
        }

        $alreadyCheckedIn = $subscription->attendances()
            ->whereDate('date', Carbon::today())
            ->exists();

        if ($alreadyCheckedIn) {
            return false;
        }

        $subscription->attendances()->create([
            'date' => Carbon::today(),
            'time' => Carbon::now()->format('H:i:s'),
        ]);

        return true;
    }
}
