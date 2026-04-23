<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CaptainFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createCaptain()
    {
        $captainType = UserType::firstOrCreate(['name' => 'Captain']);
        return User::factory()->create([
            'user_type_id' => $captainType->id,
        ]);
    }

    public function test_captain_can_access_dashboard()
    {
        $captain = $this->createCaptain();
        $response = $this->actingAs($captain)->get('/captain/dashboard');

        $response->assertStatus(200);
    }

    public function test_non_captain_cannot_access_captain_dashboard()
    {
        $clientType = UserType::firstOrCreate(['name' => 'Client']);
        $client = User::factory()->create([
            'user_type_id' => $clientType->id,
        ]);

        $response = $this->actingAs($client)->get('/captain/dashboard');

        $response->assertStatus(403);
    }

    public function test_captain_can_add_client()
    {
        $captain = $this->createCaptain();
        $plan = \App\Models\Plan::create([
            'name' => 'Monthly Plan',
            'duration_days' => 30,
            'price' => 500
        ]);

        $response = $this->actingAs($captain)->post('/captain/add-client', [
            'name' => 'New Client By Captain',
            'email' => 'clientbycaptain@example.com',
            'phone' => '0100000000',
            'plan_id' => $plan->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'clientbycaptain@example.com',
        ]);
    }
}
