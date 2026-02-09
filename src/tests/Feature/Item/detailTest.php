<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Condition;

class detailTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_detail()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create([
            'name' => 'testcondition'
        ]);
        $item = Item::factory()->create([
            'name' => 'testItem',
            'brand_name' => 'testBrand',
            'price' => 5000,
            'description' => 'いい商品',
            'image' => 'test.jpg',
            'condition_id' => $condition->id,
            'user_id' => $user->id,
        ]);
        $category1 = Category::factory()->create(['name' => 'Category1']);
        $category2 = Category::factory()->create(['name' => 'Category2']);
        $item->categories()->attach([$category1->id, $category2->id]);

        Like::factory()->count(3)->create([
            'item_id' => $item->id,
        ]);
        $commentUser = User::factory()->create();
        Comment::factory()->create([
            'item_id' => $item->id,
            'user_id' => $commentUser->id,
            'content' => 'Test Comment',
        ]);
        $response = $this->get('/item/' . $item->id);
        $response->assertStatus(200);

        $response->assertSee('testItem');
        $response->assertSee('testBrand');
        $response->assertSee('5000');
        $response->assertSee('いい商品');
        $response->assertSee('testcondition'); 
        $response->assertSee('Category1');
        $response->assertSee('Category2');
        $response->assertSee('3');
        $response->assertSee('Test Comment');
        $response->assertSee($commentUser->name);
        $response->assertSee('test.jpg');
    }
    public function test_detail_categories()
    {
        $item = Item::factory()->create();
        $category1 = Category::factory()->create(['name' => 'Category1']);
        $category2 = Category::factory()->create(['name' => 'Category2']);
        $item->categories()->attach([$category1->id, $category2->id]);
        $response = $this->get('/item/' . $item->id);
        $response->assertStatus(200);
        $response->assertSee('Category1');
        $response->assertSee('Category2');
    }
}
