<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class logoutTest extends TestCase
{
   
    public function test_logout()
    {
       $user = User::factory()->create();
       $this->actingAs($user);
       $this->assertAuthenticated(); 
       $this->post('/logout')->assertRedirect('/');
       $this->assertGuest();

        
    }
}