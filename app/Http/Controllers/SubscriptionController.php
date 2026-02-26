<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Subscription\Actions\SubscriptionService;
class SubscriptionController extends Controller
{
    protected $subscriptionService;
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

}
