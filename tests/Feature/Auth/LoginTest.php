<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET /login ログインしていない場合
     *
     * App\Http\Controllers\Auth\LoginController@showLoginForm
     * ログインしていない場合、200で表示される
     *
     * @return void
     */
    public function test_showLoginForm_whenLoggedOut()
    {
        $response = $this->get('/login');

        # 200返す
        $response->assertStatus(200);
    }

    /**
     * GET /login ログイン済みの場合
     *
     * App\Http\Controllers\Auth\LoginController@showLoginForm
     * ログイン済みの場合、 / へリダイレクトする
     *
     * @return void
     */
    public function test_showLoginForm_whenLoggedIn()
    {
        // ログインする
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // アクセス
        $response = $this->get('/login');

        # / へリダイレクトする
        $response->assertRedirect('/');
    }

    /**
     * POST /login
     *
     * App\Http\Controllers\Auth\LoginController@login
     *
     * @return void
     */
    public function test_login() {
        # ログインする
        $plainPassword = 'p4ssw0rd';
        $user = factory(User::class)->create([
            'email' => 'testlogin@example.com',
            'password' => bcrypt($plainPassword)
        ]);

        # POST
        $this->post('/login', [
            'email' => $user->email,
            'password' => $plainPassword
        ]);

        // 認証されている
        $this->assertAuthenticatedAs($user);

        $user = User::first();
        # api_tokenがセットされている
        $this->assertNotNull($user->api_token);
    }

    /**
     * POST /logout
     *
     * App\Http\Controllers\Auth\LoginController@logout
     *
     * @return void
     */
    public function test_logout() {
        // ログインする
        $plainPassword = 'p4ssw0rd';
        $user = factory(User::class)->create([
            'email' => 'testlogin@example.com',
            'password' => bcrypt($plainPassword)
        ]);
        $this->actingAs($user);

        // ログアウト
        $this->post('/logout');

        // ログアウトされている
        $this->assertGuest();
    }
}
