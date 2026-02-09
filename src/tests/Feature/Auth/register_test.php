<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class register_test extends TestCase
{
    public function testRegister()
    {
    $this->post('/register', ['name' => ''])->assertSessionHasErrors(['name' => 'お名前を入力してください']);
    $this->post('/register', ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    $this->post('/register', ['password' => ''])->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    $this->post('/register', ['password' => 'a'])->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
    $this->post('/register', [
        'password' => 'tanaka111',
        'password_confirmation' => 'tanaka444' ])->assertSessionHasErrors(['password' => 'パスワードと一致しません']);
     $this->post('/register', [
        'name' => '田中',
        'email' => 'tanaka@aaaa.jp',
        'password' => 'tanaka111',
        'password_confirmation' => 'tanaka111' ])->assertRedirect('/mypage/profile');
    }
}
