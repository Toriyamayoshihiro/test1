<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\Like;

class mylistTest extends TestCase
{
    use RefreshDatabase;

   public function test_mylist()
    {
       $user = User::factory()->create();
       $this->actingAs($user);
       $likedItem = Item::factory()->create([
        'name' => 'likedItem',
       ]);
       Like::factory()->create([
        'item_id' => $likedItem->id,
        'user_id' => $user->id,
       ]);
       $response = $this->get('/?tab=mylist');
       $response->assertStatus(200);
       $response->assertSee($likedItem->name);
    }
    public function test_mylist_sold()
    {
        $user = User::factory()->create();
       $this->actingAs($user);
       $likedItem = Item::factory()->create([
        'name' => 'likedItem',
       ]);
       Like::factory()->create([
        'item_id' => $likedItem->id,
        'user_id' => $user->id,
       ]);
       SoldItem::factory()->create([
        'item_id' => $likedItem->id,
        'user_id' => User::factory(),
       ]);
       $response = $this->get('/?tab=mylist');
       $response->assertStatus(200);
       $response->assertSee($likedItem->name);
       $response->assertSee('SOLD');
    }
    public function test_mylist_notUser()
    {
        $response = $this->get('/?tab=mylist');
        $response->assertStatus(200);
        $response->assertSee('データがありません。');
    }
    
    
}
