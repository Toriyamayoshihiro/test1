<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;

class searchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search()
    {
       $user = User::factory()->create();
       $this->actingAs($user);
       $searchedItem = Item::factory()->create([
        'name' => 'searchedItem',
       ]);
       
       $response = $this->get('/search?keyword=searched');
       $response->assertStatus(200);
       $response->assertSee($searchedItem->name);
    }
    public function test_search_mylist()
    {
       $user = User::factory()->create();
       $this->actingAs($user);
       $likedItem = Item::factory()->create([
        'name' => 'searchedItem',
       ]);
       Like::factory()->create([
        'item_id' => $likedItem->id,
        'user_id' => $user->id,
       ]);
       $response = $this->get('/search?keyword=search');
       $response->assertSessionHas('keyword','search');
       $response = $this->withSession([
        'keyword' => 'search',
       ])->get('/?tab=mylist');
       $response->assertStatus(200);
       $response->assertSee($likedItem->name);
       
    }
}
