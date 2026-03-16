<?php
namespace App\Domains\admin\Actions;
use Illuminate\Http\Request;
use App\Models\User;
class workoutroutines{
    public function index(){
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
            // Update the description in the associated plan
            $subscription->plan->update([
                'description' => $data['description'] ?? 'new subscription',
            ]);
        }
    }
}
