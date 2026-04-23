<?php

namespace App\Domains\admin\Actions;

use App\interfaces\AdminServiceInterface;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserType;
use App\Models\Subscription;
use App\Models\CaptainAttendance;

class AdminService implements AdminServiceInterface
{
    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function getAllClients()
    {
        return User::whereHas('userType', function ($query) {
            $query->where('name', 'Client');
        })->with('subscription.plan')->get();
    }

    public function createClient() {}

    public function mange() {}

    public function storeClient(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $clientType = UserType::where('name', 'Client')->first();
        $user->user_type_id = $clientType ? $clientType->id : null;
        $user->save();

        if (! empty($data['phone'])) {
            $user->phones()->create(['number' => $data['phone']]);
        }

        if (! empty($data['plan_id'])) {
            $plan = Plan::findOrFail($data['plan_id']);
        } else {
            $plan = Plan::firstOrCreate([
                'name' => $data['name_plan'],
                'duration_days' => $data['duration'],
            ], [
                'price' => $data['price'] ?? 0,
                'description' => 'باقة جديدة',
            ]);
        }

        $subscription = $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'start_date' => $data['starts_at'],
            'end_date' => $data['end_date'] ?? null,
            'paid_price' => $data['price'] ?? $plan->price,
        ]);

        if (! $subscription->end_date) {
            $subscription->calculateAndSetEndDate();
        }
        $subscription->save();

        return $user;
    }

    public function editClient($id)
    {
        $user = User::with(['userType', 'phones', 'subscription.plan'])->find($id);
        if (! $user) {
            return null;
        }

        return $user;
    }

    public function updateClient($id, array $data)
    {
        $user = User::with('userType')->find($id);
        if (! $user) {
            return null;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if (! empty($data['phone'])) {
            $user->phones()->updateOrCreate(
                ['user_id' => $user->id],
                ['number' => $data['phone']]
            );
        }

        if ($user->subscription) {
            $user->subscription->update([
                'end_date' => $data['end_date'] ?? $user->subscription->end_date,
            ]);
            $user->subscription->save();
        }

        return $user;
    }

    public function deleteClient($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return true;
        }

        return false;
    }

    public function getClientById($id)
    {
        return User::whereHas('userType', function ($q) {
            $q->where('name', 'Client');
        })
            ->with(['subscription.plan', 'subscription.diets.dietPlan'])
            ->findOrFail($id);
    }

    public function getDashboardData()
    {
        $users = $this->getAllClients();
        $usersCount = $users->count();

        $activeSubscribersCount = $users->filter(function ($user) {
            return $user->subscription && $user->subscription->is_active;
        })->count();
        $inactiveSubscribersCount = $usersCount - $activeSubscribersCount;

        return compact('users', 'usersCount', 'activeSubscribersCount', 'inactiveSubscribersCount');
    }

    public function getAllPlans()
    {
        return Plan::all();
    }

    public function getClientsWithAttendance()
    {
        return User::whereHas('userType', function ($query) {
            $query->where('name', 'Client');
        })->with(['subscription.attendances' => function ($query) {
            $query->latest()->limit(1);
        }])->get();
    }

    public function storeAttendance($subscription_id)
    {
        $subscription = Subscription::findOrFail($subscription_id);

        return $subscription->attendances()->create([
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        ]);
    }

    public function getCaptainAttendanceData()
    {
        $captains = User::whereHas('userType', function ($q) {
            $q->where('name', 'Captain');
        })->with(['phones'])->get();

        $attendances = CaptainAttendance::with('captain')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        return compact('captains', 'attendances');
    }
}
