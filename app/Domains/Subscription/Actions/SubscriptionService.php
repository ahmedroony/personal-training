<?php
namespace App\Domains\Subscription\Actions;
use App\Models\Subscription;
use App\interfaces\SubscriptionInterface;
use App\Models\User;
use Carbon\Carbon;
class SubscriptionService implements SubscriptionInterface
{
    public function storeSubscription(array $data,User $user)
    {
        $startDate = Carbon::parse($data['starts_at']);
        $duration = (int) $data['duration'];
        $endDate = $startDate->copy()->addDays($duration);
        return $user->subscriptions()->create([
            'name_plan' => $data['name_plan'],
            'starts_at' => $startDate,
            'ends_at' => $endDate,
            'duration' => $duration,
            'price' => $data['price'] ?? 0,
            'description' => $data['description'] ?? 'new subscription',
            'status' => 'active'
        ]);
    }

}
