<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\interfaces\SubscriptionInterface;

class SubscriptionController extends Controller
{
    protected $subscriptionService;
    public function __construct(SubscriptionInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

}
