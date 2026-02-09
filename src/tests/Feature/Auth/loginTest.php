<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $this->post('/login', ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
        $this->post('/login', ['password' => ''])->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
        $this->post('/login', [
        'email' => 'noname@noname.jp',
        'password' => 'noname111' ])->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません。']);
        $this->post('/register', [
        'email' => 'tanaka@tanaka.jp',
        'password' => 'tanaka1234'])->assertRedirect('/');
    }
}
