<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class purchaseTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_purchase()
    {
        $buyer = User::factory()->create();

        $this->actingAs($buyer);
        
        $item = Item::factory()->create();
        $this->withSession([
            'purchase_address' => [
            'postal_code' => '123-4567',
            'address' => 'Tokyo',
            'building' => 'Test Building',
            ]
        ])->get("/purchase/success/{$item->id}");


        $this->assertDatabaseHas('sold_items', [
            'item_id' => $item->id,
            'user_id' => $buyer->id,
        ]);
    }
    public function test_purchase_sold()
    {
        $buyer = User::factory()->create();
        $this->actingAs($buyer);

        $item = Item::factory()->create();
        $this->withSession([
            'purchase_address' => [
            'postal_code' => '123-4567',
            'address' => 'Tokyo',
            'building' => 'Test Building',
            ]
        ])->get("/purchase/success/{$item->id}");

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SOLD');
    }
    public function test_purchase_mypage()
    {
        $buyer = User::factory()->create();

        $this->actingAs($buyer);
        
        $item = Item::factory()->create();
        $this->withSession([
            'purchase_address' => [
            'postal_code' => '123-4567',
            'address' => 'Tokyo',
            'building' => 'Test Building',
            ]
        ])->get("/purchase/success/{$item->id}");
        $response = $this->get('/mypage/?page=buy');
        $response->assertStatus(200);
        $response->assertSee($item->name);

    }

}
