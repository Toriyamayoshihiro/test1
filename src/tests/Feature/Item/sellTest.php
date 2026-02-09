<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;

class sellTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_sell()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $cat1 = Category::factory()->create(['name' => '本']);
        $cat2 = Category::factory()->create(['name' => '家電']);
        $condition = Condition::factory()->create(['name' => '新品']);

        $this->get('/sell')->assertStatus(200);

        $file = UploadedFile::fake()->create(
            'test.jpg',
            100,
            'image/jpeg'
            );

        $payload = [
            'image' => $file,
            'item_category' => [$cat1->id, $cat2->id],
            'condition_id' => $condition->id,
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 9999,
        ];

        $response = $this->post('/item/upload', $payload);

        $response->assertRedirect('/mypage');

        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 9999,
            'condition_id' => $condition->id,
            'user_id' => $user->id,
            'image' => 'test.jpg', 
        ]);

        
        Storage::disk('public')->assertExists('items/test.jpg');

        $item = Item::where('name', 'テスト商品')->firstOrFail();

        $this->assertDatabaseHas('category_item', [
            'item_id' => $item->id,
            'category_id' => $cat1->id,
        ]);
        $this->assertDatabaseHas('category_item', [
            'item_id' => $item->id,
            'category_id' => $cat2->id,
        ]);
    }
    
}
