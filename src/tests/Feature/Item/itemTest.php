<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\SoldItem;


class itemTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
       $items = Item::factory()->count(3)->create();
       $response = $this->get('/');
       $response->assertStatus(200);
       foreach($items as $item) {
        $response->assertSee($item->name);
       }
    }
    public function test_index_sold()
    {
        $item = Item::factory()->create();
        SoldItem::factory()->create([
            'item_id' => $item->id,
            'user_id' => User::factory(),
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SOLD');
    }
    public function test_index_myItem()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $myItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'myItem'
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('myItem');

    }
}
