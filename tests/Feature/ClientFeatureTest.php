<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createClient()
    {
        $clientType = UserType::firstOrCreate(['name' => 'Client']);
        return User::factory()->create([
            'user_type_id' => $clientType->id,
        ]);
    }

    public function test_client_can_access_dashboard()
    {
        $client = $this->createClient();
        $response = $this->actingAs($client)->get('/client/dashboard');

        $response->assertStatus(200);
    }

    public function test_non_client_cannot_access_client_dashboard()
    {
        $captainType = UserType::firstOrCreate(['name' => 'Captain']);
        $captain = User::factory()->create([
            'user_type_id' => $captainType->id,
        ]);

        $response = $this->actingAs($captain)->get('/client/dashboard');

        $response->assertStatus(403);
    }
}
