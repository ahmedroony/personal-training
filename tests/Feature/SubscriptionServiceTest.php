<?php

namespace Tests\Feature;

use App\Domains\Subscription\Actions\SubscriptionService;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_example(): void
    {
        $user = User::factory()->create();

        $data = [
            'name_plan' => 'primary_plan',
            'duration' => 20,
            'description' => 'hello from test',
            'price' => 200,
            'starts_at' => '2025-01-01',
        ];

        $service = new SubscriptionService;
        $subscription = $service->storeSubscription($data, $user);

        $this->assertDatabaseHas('plans', [
            'name' => 'primary_plan',
            'duration_days' => 20,
        ]);

        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $user->id,
            'paid_price' => 200,
        ]);

        $this->assertInstanceOf(Subscription::class, $subscription);
    }
}
