<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Sellers;
use App\Models\User;
use App\Models\SalesCommission;

class PostSaleTest extends TestCase
{
    use DatabaseMigrations;

    public function testPostSaleReturnOK()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $seller = Sellers::factory()->create();

        SalesCommission::factory()->create();

        $data = [
            'seller_id' => 1, // Seller existe
            'amount' => '100.05',
            'sale_date' => '2025-05-16'
        ];

        $response = $this->post('/api/sales', $data);

        $response->assertStatus(200);
    }

    public function testPostSaleReturnError()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $data = [
            'seller_id' => 999, // Seller não existe
            'amount' => '100.05',
            'sale_date' => '2025-05-16'
        ];

        $response = $this->post('/api/sales', $data);

        $response->assertStatus(401);
    }
}
