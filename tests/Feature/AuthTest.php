<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login')
                    ->assertStatus(200)
                    ->assertViewIs('auth.login');
    }

    public function test_login_page_is_the_default_page(): void
    {
        $response = $this->get('/')
                    ->assertStatus(302)
                    ->assertRedirect('/login');
    }

    public function test_unauthorized_user_can_not_view_dashboard(): void
    {
        $response = $this->get('/admin/dashboard')
                        ->assertRedirect('/login')
                        ->assertStatus(302);
    }

    public function test_authorized_user_can_view_dashboard(): void
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => bcrypt('1234')
        ]);

        $response = $this->actingAs($user)
                        ->get('/admin/dashboard')
                        ->assertStatus(302);
    }
}
