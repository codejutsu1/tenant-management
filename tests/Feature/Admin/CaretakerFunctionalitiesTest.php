<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CaretakerFunctionalitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_renew_payment_functionality()
    {
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get('caretaker/renew-payment/1');

        $response->assertStatus(302);
    }

    public function test_view_occupants_functionality()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('caretaker/view-occupants/1');

        $response->assertStatus(200);
    }

    public function test_change_room_functionality()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('caretaker/change-room/1');

        $response->assertStatus(200);
    }

    public function test_change_tenant_room_functionality()
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($user)->get('caretaker/change-tenant-room/1');

        $response->assertStatus(200);
    }
}
