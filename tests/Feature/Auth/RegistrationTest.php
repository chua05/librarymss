<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'full_name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'date_of_birth' => '2000-01-01',
            'contact_number' => '0123456789',
            'address' => 'Test Address',
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree_terms' => true,
            'confirm_email_verification' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
