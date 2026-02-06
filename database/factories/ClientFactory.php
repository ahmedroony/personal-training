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
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Default password
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'captain_id' => null, // or you can assign a random captain ID if needed
            // 'package_id' => null, // or you can assign a random package ID if needed
        ];
    }
}
