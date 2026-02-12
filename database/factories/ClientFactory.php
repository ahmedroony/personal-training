<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Client\ModelClient\Client;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Client::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'package_name'=>$this->faker->name(),
            'subscription_starts_at'=>$this->faker->date(),
            'subscription_ends_at'=>$this->faker->dateTimeThisYear(),
            'email' => $this->faker->unique()->safeEmail(),
            // 'password' => bcrypt('password'), // Default password
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'package_price' => $this->faker->randomFloat(2, 10, 100), // Random price between 10 and 100
            'duration_days' => $this->faker->numberBetween(1, 30),
            'captain_id' => null, // or you can assign a random captain ID if needed
            // 'package_id' => null, // or you can assign a random package ID if needed
        ];
    }
}
