<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'role' => 0, // 0 = Admin
        ]);
        $captain = User::create([
            'name' => 'Captain User',
            'email' => 'captain@captain.com',
            'password' => bcrypt('12345678'),
            'role' => 1, // 1 = Captain
        ]);
        User::create([
            'name' => 'Regular User',
            'email' => 'regular@regular.com',
            'password' => bcrypt('12345678'),
            'role' => 2, // 2 = Regular User
            'captain_id' => $captain->id,
        ]);
        Plan::create([
            'name_plan' => 'Basic Plan',
            'price' => 100.00,
            'description'=>'A basic workout plan for beginners.',
        ]);
        $this->call([
            PlanSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
