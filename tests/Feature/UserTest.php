<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirect_to_dashboard_successfully()
    {
        User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }

    public function test_auth_user_can_access_dashboard()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertOk();
    }

    public function test_unauth_user_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_user_has_name_attribute()
    {
        $user = User::factory()->create([
            'name' => 'John',
            'email' => 'test@test.com',
            'password' => bcrypt('password123'),
        ]);

        // $this->assertEquals(strtoupper('John'), $user->name);
        $this->assertEquals('John', $user->name);

    }
}
