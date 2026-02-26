<?php
namespace App\interfaces;
use App\Models\User;
interface SubscriptionInterface
{
    public function storeSubscription(array $data,User $user);
}
