<?php

namespace Tests\Feature\SuperAdmin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SuperAdminPagesTest extends TestCase
{
    protected $seed = true;
    
    use RefreshDatabase;

    public function test_dashboard_page_is_working()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/dashboard');

        $response->assertStatus(200);
    }

    public function test_all_users_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/all-users');

        $response->assertStatus(200);
    }

    public function test_tenants_index_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/tenants/index');

        $response->assertStatus(200);
    }

    public function test_tenants_show_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/tenants/show');

        $response->assertStatus(200);
    }

    public function test_tenants_create_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/tenants/create');

        $response->assertStatus(200);
    }

    public function test_tenants_edit_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/tenants/edit');

        $response->assertStatus(200);
    }

    public function test_caretakers_index_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/caretakers/index');

        $response->assertStatus(200);
    }

    public function test_caretakers_create_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/caretakers/create');

        $response->assertStatus(200);
    }

    public function test_caretakers_show_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/caretakers/show');

        $response->assertStatus(200);
    }

    public function test_caretakers_edit_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/caretakers/edit');

        $response->assertStatus(200);
    }

    public function test_settings_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/settings');

        $response->assertStatus(200);
    }

    public function test_new_payment_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/new-payment');

        $response->assertStatus(200);
    }

    public function test_all_transactions_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/all-transactions');

        $response->assertStatus(200);
    }

    public function test_select_room_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('/landlord/select-room');

        $response->assertStatus(200);
    }

    
}
