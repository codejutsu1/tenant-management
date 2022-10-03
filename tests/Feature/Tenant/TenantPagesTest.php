<?php

namespace Tests\Feature\Tenant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TenantPagesTest extends TestCase
{
    protected $seed = true;

    use RefreshDatabase;

    public function test_tenant_dashboard_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/dashboard');

        $response->assertStatus(200);
    }

    public function test_tenant_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment');

        $response->assertStatus(200);
    }

    public function test_tenant_receipt_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/receipt');

        $response->assertStatus(200);
    }

    public function test_tenant_transaction_history_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/transaction-history');

        $response->assertStatus(200);
    }

    public function test_tenant_account_details_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/account-details');

        $response->assertStatus(200);
    }

    public function test_tenant_choose_room_page()
    {
        $user = User::factory()->create(['role_id' => 3, 'paid' => 1]);

        $response = $this->actingAs($user)->get('/tenant/choose-room');

        $response->assertStatus(200);
    }

    public function test_tenant_lodge_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment/house-lodge-payment');

        $response->assertStatus(200);
    }

    public function test_tenant_other_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment/other-payments');

        $response->assertStatus(200);
    }

    public function test_tenant_online_banking_lodge_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment/house-lodge-payment/online-banking');

        $response->assertStatus(200);
    }

    public function test_tenant_offline_banking_lodge_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment/house-lodge-payment/offline-banking');

        $response->assertStatus(200);
    }

    public function test_tenant_crypto_lodge_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment/house-lodge-payment/crypto');

        $response->assertStatus(200);
    }

    public function test_tenant_online_banking_other_payment_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/payment/other-payment/online-banking');

        $response->assertStatus(200);
    }

    public function test_tenant_settings_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/settings');

        $response->assertStatus(200);
    }

    public function test_tenant_edit_page()
    {
        $user = User::factory()->create(['role_id' => 3]);

        $response = $this->actingAs($user)->get('/tenant/user-edit');

        $response->assertStatus(200);
    }
}
