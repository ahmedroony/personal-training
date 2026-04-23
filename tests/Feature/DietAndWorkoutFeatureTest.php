<?php

namespace Tests\Feature;

use App\Models\DietPlan;
use App\Models\User;
use App\Models\UserType;
use App\Models\Subscription;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DietAndWorkoutFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin()
    {
        $adminType = UserType::firstOrCreate(['name' => 'Admin']);
        return User::factory()->create([
            'user_type_id' => $adminType->id,
        ]);
    }

    public function test_admin_can_view_diet_plans_page()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->get(route('create_diet_plans.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_store_diet_plan()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->post(route('create_diet_plans.store'), [
            'name' => 'Keto Diet',
            'base_description' => 'Low carb, high fat diet description.',
        ]);

        $response->assertRedirect(route('create_diet_plans.index'));
        $this->assertDatabaseHas('diet_plans', [
            'name' => 'Keto Diet',
        ]);
    }

    public function test_admin_can_assign_diet_plan_to_subscription()
    {
        $admin = $this->createAdmin();
        $clientType = UserType::firstOrCreate(['name' => 'Client']);
        $client = User::factory()->create(['user_type_id' => $clientType->id]);

        $plan = Plan::create([
            'name' => 'Basic Plan',
            'duration_days' => 30,
            'price' => 100,
        ]);

        $subscription = Subscription::create([
            'user_id' => $client->id,
            'plan_id' => $plan->id,
            'starts_at' => now(),
            'expires_at' => now()->addDays(30),
            'status' => 'active',
        ]);

        $dietPlan = DietPlan::create([
            'name' => 'Standard Diet',
            'base_description' => 'Description here',
        ]);

        $response = $this->actingAs($admin)->post(route('diet_plans.store'), [
            'subscription_id' => $subscription->id,
            'diet_plan_id' => $dietPlan->id,
            'custom_notes' => 'Some custom notes for client',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('diets', [
            'subscription_id' => $subscription->id,
            'diet_plan_id' => $dietPlan->id,
        ]);
    }

    public function test_admin_can_view_workout_plans_page()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->get(route('workout-plan.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_update_workout_description_for_user()
    {
        $admin = $this->createAdmin();
        $clientType = UserType::firstOrCreate(['name' => 'Client']);
        $client = User::factory()->create(['user_type_id' => $clientType->id]);

        $plan = Plan::create([
            'name' => 'Workout Plan A',
            'duration_days' => 30,
            'price' => 200,
        ]);

        $subscription = Subscription::create([
            'user_id' => $client->id,
            'plan_id' => $plan->id,
            'starts_at' => now(),
            'expires_at' => now()->addDays(30),
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->post(route('workout-plan.store'), [
            'user_id' => $client->id,
            'description' => 'New workout plan description for client.',
        ]);

        $response->assertRedirect(route('workout-plan.index'));
        $this->assertDatabaseHas('plans', [
            'id' => $plan->id,
            'description' => 'New workout plan description for client.',
        ]);
    }
}
