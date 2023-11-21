<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SallaTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_redirect_to_salla_if_no_token_set()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
        ]);

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertRedirectToRoute('oauth.redirect')
            ->assertStatus(302);
    }

    // public function test_can_get_access_token()
    // {
    //     $user = User::create([
    //         'name' => 'test',
    //         'email' => 'test@test.com',
    //         'password' => bcrypt('123456'),
    //     ]);

    //     $response = $this->actingAs($user)
    //         ->get('/admin/dashboard');
    // }
}
