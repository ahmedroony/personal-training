<?php

namespace App\Domains\Captain\Actions;

use App\Models\CaptainAttendance;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CaptainService
{
    public function getAttendances()
    {
        return CaptainAttendance::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    public function getMonthCount()
    {
        return CaptainAttendance::where('user_id', Auth::id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->count();
    }

    public function attendedToday()
    {
        return CaptainAttendance::where('user_id', Auth::id())
            ->where('date', Carbon::today())
            ->exists();
    }

    public function checkIn()
    {
        if ($this->attendedToday()) {
            return false;
        }

        CaptainAttendance::create([
            'user_id' => Auth::id(),
            'date' => Carbon::today(),
            'time' => Carbon::now()->format('H:i:s'),
        ]);

        return true;
    }


    public function getAllClients()
    {
        $clientType = UserType::where('name', 'Client')->first();
        if (! $clientType) {
            return collect();
        }

        return User::where('user_type_id', $clientType->id)->get();
    }


    public function getActivePlans()
    {
        return Plan::all();
    }


    public function getCaptainClients()
    {
        return User::where('captain_id', Auth::id())
            ->with(['subscription.plan'])
            ->get();
    }


    public function assignClientToCaptain(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'] ?? null;
        $user->password = bcrypt(substr($data['phone'], -6));

        $clientType = UserType::where('name', 'Client')->first();
        $user->user_type_id = $clientType ? $clientType->id : null;
        $user->captain_id = Auth::id();
        $user->save();

        if (! empty($data['phone'])) {
            $user->phones()->create(['number' => $data['phone']]);
        }

        $plan = Plan::findOrFail($data['plan_id']);
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'paid_price' => $plan->price,
            'start_date' => Carbon::today(),
            'end_date' => Carbon::today()->addDays($plan->duration_days),
        ]);

        return $subscription;
    }
}
