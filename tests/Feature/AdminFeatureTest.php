<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin()
    {
        $adminType = UserType::firstOrCreate(['name' => 'Admin']);
        return User::factory()->create([
            'user_type_id' => $adminType->id,
        ]);
    }

    public function test_admin_can_access_dashboard()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_manage_page()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->get('/admin/manage');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_dashboard()
    {
        $clientType = UserType::firstOrCreate(['name' => 'Client']);
        $client = User::factory()->create([
            'user_type_id' => $clientType->id,
        ]);

        $response = $this->actingAs($client)->get('/admin');

        $response->assertStatus(403);
    }

    public function test_admin_can_create_client()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->post('/admin/storeclient', [
            'name' => 'New Client',
            'email' => 'newclient@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '1234567890',
            'starts_at' => now()->toDateString(),
            'name_plan' => 'Basic Plan',
            'duration' => 30,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'newclient@example.com',
        ]);
    }

    public function test_admin_can_delete_client()
    {
        $admin = $this->createAdmin();
        $clientType = UserType::firstOrCreate(['name' => 'Client']);
        $client = User::factory()->create([
            'user_type_id' => $clientType->id,
        ]);

        $response = $this->actingAs($admin)->delete('/admin/deleteClient/' . $client->id);

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', [
            'id' => $client->id,
        ]);
    }

    public function test_admin_can_view_settings_page()
    {
        $admin = $this->createAdmin();
        $response = $this->actingAs($admin)->get(route('setting.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_delete_plan()
    {
        $admin = $this->createAdmin();
        $plan = \App\Models\Plan::create([
            'name' => 'Plan to Delete',
            'duration_days' => 30,
            'price' => 100,
        ]);

        $response = $this->actingAs($admin)->delete(route('setting.delete', $plan->id));

        $response->assertRedirect(route('setting.index'));
        $this->assertDatabaseMissing('plans', [
            'id' => $plan->id,
        ]);
    }

    public function test_admin_can_delete_diet_plan()
    {
        $admin = $this->createAdmin();
        $dietPlan = \App\Models\DietPlan::create([
            'name' => 'Diet Plan to Delete',
            'base_description' => 'Description',
        ]);

        $response = $this->actingAs($admin)->delete(route('setting.diet.delete', $dietPlan->id));

        $response->assertRedirect(route('setting.index'));
        $this->assertDatabaseMissing('diet_plans', [
            'id' => $dietPlan->id,
        ]);
    }
}
