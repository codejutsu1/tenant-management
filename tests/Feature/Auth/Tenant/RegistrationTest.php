<?php

namespace Tests\Feature\Auth\Tenant;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role_id' => 3,
            'gender' => 'male',
            'type' => 'none',
            'lga' => 'james',
            'state' => 'lousinna',
            'occupation' => 'aurje',
            'phone' => '39389398886',
            'dob' => '1993-08-27'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::TENANT);
    }
}
