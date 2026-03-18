<?php

namespace App\Domains\admin\Actions;

use App\interfaces\AdminServiceInterface;
use App\Models\User;
use App\Models\Plan;
use App\Models\UserType;
use Carbon\Carbon;  
use Illuminate\Http\Request;

class AdminService implements AdminServiceInterface
{
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function getAllClients()
    {
        $users = User::whereHas('userType', function ($q) {
            $q->where('name', 'Client');
        })->with('subscription.plan')->get();

        foreach ($users as $user) {
            $sub = $user->subscription;
            $user->name_plan = ($sub && $sub->plan) ? $sub->plan->name : 'لا يوجد اشتراك';
            $user->total_days = ($sub && $sub->plan) ? $sub->plan->duration_days : 0;
            $user->remaining_days = $sub ? $sub->remaining_days : 0;
            $user->current_status = ($sub && $sub->is_active) ? 'active' : 'inactive';
        }

        return $users;
    }

    public function createClient() {}

    public function mange() {}

    public function storeClient(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone_number = $data['phone'] ?? null;
        $clientType = UserType::where('name', 'Client')->first();
        $user->user_type_id = $clientType ? $clientType->id : null;
        $user->save();

        if (!empty($data['plan_id'])) {
            $plan = Plan::findOrFail($data['plan_id']);
        } else {
            $plan = Plan::firstOrCreate([
                'name' => $data['name_plan'],
                'duration_days' => $data['duration'] ?? 30,
            ], [
                'price' => $data['price'] ?? 0,
                'description' => $data['description'] ?? 'new subscription'
            ]);
        }

        $subscription = $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'start_date' => $data['starts_at'],
            'price' => $data['price'] ?? $plan->price,
        ]);
        
        //the logic of end date and status is in the subscription model
        $subscription->calculateAndSetEndDate()->checkAndUpdateStatus()->save();

        return $user;
    }

    public function editClient($id)
    {
        $user = User::with('userType')->find($id);
        if (! $user || ($user->userType->name ?? '') != 'Client') {
            return null; 
        }
        return $user;
    }

    public function updateClient($id,array $data)
    {
        $user = User::with('userType')->find($id);
        if (!$user || ($user->userType->name ?? '') != 'Client') {
            return null;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);
        $subscription = $user->subscription;

        $plan = Plan::firstOrCreate([
            'name' => $data['name_plan'],
            'duration_days' => $data['duration'],
        ]);

        if ($subscription) {
            $subscription->update([
                'plan_id' => $plan->id,
                // نحدث start_date للـ today فقط لو لم يكن موجود
                'start_date' => $subscription->start_date ?? Carbon::today(),
            ]);
            $subscription->calculateAndSetEndDate()->checkAndUpdateStatus()->save();
        } else {
            $newSubscription = $user->subscriptions()->create([
                'plan_id' => $plan->id,
                'start_date' => Carbon::today(),
                'price' => 0,
            ]);
            $newSubscription->calculateAndSetEndDate()->checkAndUpdateStatus()->save();
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
            ->with(['subscription.plan', 'dietPlans'])
            ->findOrFail($id);
    }
}
