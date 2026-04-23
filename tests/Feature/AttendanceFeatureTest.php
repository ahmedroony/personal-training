<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserType;
use App\Models\Subscription;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin()
    {
        $adminType = UserType::firstOrCreate(['name' => 'Admin']);
        return User::factory()->create([
            'user_type_id' => $adminType->id,
        ]);
    }

    public function test_admin_can_view_attendance_page()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->get(route('admin.attendance'));
        $response->assertStatus(200);
    }

    public function test_admin_can_store_attendance_for_subscription()
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

        $response = $this->actingAs($admin)->post(route('admin.attendance.store', $subscription->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('attendances', [
            'subscription_id' => $subscription->id,
        ]);
    }
}
