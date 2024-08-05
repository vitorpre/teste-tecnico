<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_payment_store_pix(): void
    {
        $this->postJson('/api/conta', [
            'numero_conta' => '123456',
            'saldo' => 1000
        ]);

        $response = $this->postJson('/api/transacao', [
            'numero_conta' => '123456',
            'forma_pagamento' => 'P',
            'valor' => 100
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => '123456',
                'saldo' => '900.00'
            ]);
    }

    public function test_payment_store_credit(): void
    {
        $this->postJson('/api/conta', [
            'numero_conta' => '123456',
            'saldo' => 1000
        ]);

        $response = $this->postJson('/api/transacao', [
            'numero_conta' => '123456',
            'forma_pagamento' => 'C',
            'valor' => 25
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => '123456',
                'saldo' => '973.75'
            ]);
    }

    public function test_payment_store_debit(): void
    {
        $this->postJson('/api/conta', [
            'numero_conta' => '123456',
            'saldo' => 1000
        ]);

        $response = $this->postJson('/api/transacao', [
            'numero_conta' => '123456',
            'forma_pagamento' => 'D',
            'valor' => 25
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => '123456',
                'saldo' => '974.25'
            ]);
    }

    public function test_payment_store_account_not_found(): void
    {
        $response = $this->postJson('/api/transacao', [
            'numero_conta' => '123456',
            'forma_pagamento' => 'D',
            'valor' => 25
        ]);

        $response->assertStatus(422)
            ->assertJson(["message" => "Conta não encontrada"]);
    }

    public function test_payment_store_not_enough_balance(): void
    {
        $this->postJson('/api/conta', [
            'numero_conta' => '123456',
            'saldo' => 25
        ]);

        $response = $this->postJson('/api/transacao', [
            'numero_conta' => '123456',
            'forma_pagamento' => 'D',
            'valor' => 25
        ]);

        $response->assertStatus(404)
            ->assertJson(["message" => "Saldo insuficiente"]);
    }
}
