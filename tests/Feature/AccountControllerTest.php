<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = $this->createMock(Account::class);
    }

    public function test_account_store(): void
    {
        $response = $this->postJson('/api/conta', [
            'numero_conta' => '123456',
            'saldo' => 1000
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => '123456',
                'saldo' => '1,000.00'
            ]);
    }

    public function test_account_show(): void
    {
        $response = $this->postJson('/api/conta', [
            'numero_conta' => '123456',
            'saldo' => 1000
        ]);

        $response = $this->get('/api/conta/123456');

        $response->assertStatus(200)
            ->assertJson([
                'numero_conta' => '123456',
                'saldo' => '1,000.00'
            ]);
    }

    public function test_account_show_not_found(): void
    {
        $response = $this->get('/api/conta/555');

        $response->assertStatus(404)
            ->assertJson(['message' => 'Conta não encontrada']);
    }
}
