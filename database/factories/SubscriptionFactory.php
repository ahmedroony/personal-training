<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = fake()->dateTimeBetween('-1 month', 'now');
        return [
            // مش هنحط user_id و plan_id هنا، هنمررهم في السيدر
            'subscription_starts_at' => $startsAt,
            'subscription_ends_at' => fake()->dateTimeBetween($startsAt, '+6 months'),
            'status' => fake()->randomElement(['active', 'expired']),
        ];
    }
}
