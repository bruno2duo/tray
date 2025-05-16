<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Seller;
use App\Models\User;

class PostSellerTest extends TestCase
{
    use RefreshDatabase;

    public function testPostSellerReturnOK()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $data = [
            'nome' => 'Loja Teste',
            'email' => 'teste2@loja.com'
        ];

        $response = $this->post('/api/sellers', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('sellers', [
            'email' => 'teste2@loja.com',
        ]);
    }

    public function testPostSellerReturnError()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $data = [
            'nome' => 'Loja Teste',
            'email' => 'teste2.loja.com'
        ];

        $response = $this->post('/api/sellers', $data);

        $response->assertStatus(401);
    }
}
