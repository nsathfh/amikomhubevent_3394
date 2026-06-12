<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guest is redirected to login page when accessing admin dashboard.
     */
    public function test_guest_is_redirected_to_login_page(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    /**
     * Test that admin can log in with correct credentials.
     */
    public function test_admin_can_login_with_correct_credentials(): void
    {
        // Seed user admin using forceCreate to bypass mass assignment protection for 'role'
        $admin = User::forceCreate([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@amikom.ac.id',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    /**
     * Test that user with wrong credentials cannot log in.
     */
    public function test_admin_cannot_login_with_wrong_password(): void
    {
        User::forceCreate([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@amikom.ac.id',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test that non-admin users cannot access dashboard.
     */
    public function test_non_admin_user_cannot_access_dashboard(): void
    {
        $user = User::forceCreate([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);


        $response = $this->post('/admin/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
