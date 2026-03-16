<?php
namespace App\Domains\Subscription\Actions;
use App\Models\Subscription;
use App\interfaces\SubscriptionInterface;
use App\Models\User;
use App\Models\Plan;
use Carbon\Carbon;
class SubscriptionService implements SubscriptionInterface
{
    public function storeSubscription(array $data, User $user)
    {
        $plan = Plan::firstOrCreate([
            'name' => $data['name_plan'],
            'duration_days' => (int) $data['duration'],
        ], [
            'price' => $data['price'] ?? 0,
            'description' => $data['description'] ?? 'new subscription'
        ]);

        $subscription = $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'start_date' => Carbon::parse($data['starts_at']),
            'price' => $data['price'] ?? 0,
        ]);

        $subscription->calculateAndSetEndDate()->checkAndUpdateStatus()->save();

        return $subscription;
    }

}
