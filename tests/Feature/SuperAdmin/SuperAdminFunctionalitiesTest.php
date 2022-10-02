<?php

namespace Tests\Feature\SuperAdmin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SuperAdminFunctionalitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_activate_user_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('landlord/activate-user/1');

        $response->assertStatus(302);
    }

    public function test_deactivate_user_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('landlord/deactivate-user/0');

        $response->assertStatus(302);
    }

    public function test_renew_payment_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('landlord/renew-payment/1');

        $response->assertStatus(302);
    }

    public function test_view_occupants_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('landlord/view-occupants/1');

        $response->assertStatus(200);
    }

    public function test_change_room_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('landlord/change-room/1');

        $response->assertStatus(200);
    }

    public function test_change_room_tenant_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('landlord/change-room-tenant/1');

        $response->assertStatus(200);
    }
}
