<?php
namespace App\Domains\Subscription\Actions;
use App\Models\Subscription;
use App\interfaces\SubscriptionInterface;
use App\Models\User;
class SubscriptionService implements SubscriptionInterface
{
    public function storeSubscription(array $data,User $user)
    {
        return $user->subscriptions()->create([
            'name_plan' => $data['name_plan'],
            'price' => $data['price'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'],
            'status' => 'active',
        ]);
    }
}
