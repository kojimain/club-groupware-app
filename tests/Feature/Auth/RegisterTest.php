<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET /register ログインしていない場合
     *
     * App\Http\Controllers\Auth\RegisterController@showRegistrationForm
     * ログインしていない場合、200で表示される
     *
     * @return void
     */
    public function test_showRegistrationForm_whenLoggedOut()
    {
        $response = $this->get('/register');

        # 200返す
        $response->assertStatus(200);
    }

    /**
     * GET /register ログイン済みの場合
     *
     * App\Http\Controllers\Auth\RegisterController@showRegistrationForm
     * ログイン済みの場合、 / へリダイレクトする
     *
     * @return void
     */
    public function test_showRegistrationForm_whenLoggedIn()
    {
        // ログインする
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // アクセス
        $response = $this->get('/register');

        # / へリダイレクトする
        $response->assertRedirect('/');
    }

    /**
     * POST /register
     *
     * App\Http\Controllers\Auth\RegisterController@register
     *
     * @return void
     */
    public function test_register() {
        $response = $this->post('/register', [
            'name' => 'nametest',
            'email' => 'test@example.com',
            'password' => 'p4ssw0rd',
            'password_confirmation' => 'p4ssw0rd'
        ]);

        # / へリダイレクト
        $response->assertRedirect('/');

        # 認証されている
        $this->assertAuthenticated();

        # Userが登録されている
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);

        $user = User::first();
        # api_tokenがセットされている
        $this->assertNotNull($user->api_token);
    }
}
