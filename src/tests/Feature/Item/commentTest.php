<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class commentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $item = Item::factory()->create();
        $response = $this->get("/item/{$item->id}");
        $response->assertSee('<p class="detail__icon-count">0</p>', false);

        $response = $this->post("/item/{$item->id}/add", [
            'content' => 'テストコメント',
            'id' => $item->id, 
        ])->assertRedirect(route('detail.item', ['item_id' => $item->id]));

        $this->assertDatabaseHas('comments', [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'content' => 'テストコメント',
        ]);
         $this->get("/item/{$item->id}")
            ->assertSee('<p class="detail__icon-count">1</p>', false);
        
    }
    public function test_guest_cannot_comment()
    {
        $item = Item::factory()->create();
            $this->post("/item/{$item->id}/add", [
            'content' => 'ゲストコメント',
            'id' => $item->id,
        ])->assertRedirect('/login');

    }
    public function test_comment_required_validation()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user);
        $this->from("/item/{$item->id}")
            ->post("/item/{$item->id}/add", [
                'content' => '',
                'id' => $item->id,
            ])
            ->assertRedirect("/item/{$item->id}")
            ->assertSessionHasErrors(['content']);

       
    }
    public function test_comment_max_validation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $item = Item::factory()->create();

        $longComment = str_repeat('a', 256);

        $this->from("/item/{$item->id}")
            ->post("/item/{$item->id}/add", [
                'content' => $longComment,
                'id' => $item->id,
            ])
            ->assertRedirect("/item/{$item->id}")
            ->assertSessionHasErrors(['content']);

       
    }

}
