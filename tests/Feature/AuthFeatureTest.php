<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $userType = UserType::create(['name' => 'Client']);
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'user_type_id' => $userType->id,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(); // Usually redirects to home or dashboard
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $userType = UserType::create(['name' => 'Client']);
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'user_type_id' => $userType->id,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $userType = UserType::create(['name' => 'Client']);
        $user = User::factory()->create([
            'user_type_id' => $userType->id,
        ]);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect();
    }
}
