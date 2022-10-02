<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminPagesTest extends TestCase
{
    protected $seed = true;

    use RefreshDatabase;

    public function test_caretaker_dashboard_page()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('/caretaker/dashboard');

        $response->assertStatus(200);
    }

    public function test_settings_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('/caretaker/settings');

        $response->assertStatus(200);
    }

    public function test_new_payment_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('/caretaker/new-payment');

        $response->assertStatus(200);
    }

    public function test_all_transactions_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('/caretaker/all-transactions');

        $response->assertStatus(200);
    }

    public function test_select_room_page_is_working()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('/caretaker/select-room');

        $response->assertStatus(200);
    }
}
