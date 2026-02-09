<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\Profile;

class address_editTest extends TestCase
{
    use RefreshDatabase;

    public function test_address_updated_reflects_on_purchase_page()
    {

        $buyer = User::factory()->create();

        
        Profile::factory()->create([
            'user_id' => $buyer->id,
            'postal_code' => '000-0000',
            'address' => 'Old Address',
            'building' => 'Old Building',
        ]);
        $seller = User::factory()->create();
        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $this->actingAs($buyer);

        $this->post("/purchase/address/{$item->id}", [
            'postal_code' => '123-4567',
            'address'     => 'Tokyo',
            'building'    => 'Test Building',
            'id'          => $item->id,
        ])->assertRedirect(route('purchase.item', ['item_id' => $item->id]));

       
        $res = $this->get(route('purchase.item', ['item_id' => $item->id]));
        $res->assertStatus(200);

        
        $res->assertSee('value="123-4567"', false);
        $res->assertSee('value="Tokyo"', false);
        $res->assertSee('value="Test Building"', false);
    }
    public function test_purchase_saves_address_into_sold_items()
    {
        $buyer = User::factory()->create();
        Profile::factory()->create([
        'user_id' => $buyer->id,
        'postal_code' => '000-0000',
        'address' => 'Old Address',
        'building' => 'Old Building',
        ]);
        $seller = User::factory()->create();
        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $this->actingAs($buyer);

        $this->post("/purchase/address/{$item->id}", [
            'postal_code' => '123-4567',
            'address'     => 'Tokyo',
            'building'    => 'Test Building',
            'id'          => $item->id,
        ]);

        $this->get(route('purchase.success', ['item_id' => $item->id]))
            ->assertRedirect('/');

        $this->assertDatabaseHas('sold_items', [
            'item_id'      => $item->id,
            'user_id'      => $buyer->id,
            'postal_code'  => '123-4567',
            'address'      => 'Tokyo',
            'building'     => 'Test Building',
        ]);
    }
}