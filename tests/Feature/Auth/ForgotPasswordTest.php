<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use App\User;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET /password/reset ログインしていない場合
     *
     * App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm
     * ログインしていない場合、200で表示される
     *
     * @return void
     */
    public function test_showLinkRequestForm_whenLoggedOut()
    {
        $response = $this->get('/password/reset');

        # 200返す
        $response->assertStatus(200);
    }

    /**
     * GET /password/reset ログイン済みの場合
     *
     * App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm
     * ログイン済みの場合、 / へリダイレクトする
     *
     * @return void
     */
    public function test_showLinkRequestForm_whenLoggedIn()
    {
        // ログインする
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // アクセス
        $response = $this->get('/password/reset');

        # / へリダイレクトする
        $response->assertRedirect('/');
    }

    /**
     * POST /password/email
     *
     * App\Http\Controllers\Auth\ResetPasswordController@sendResetLinkEmail
     *
     * @return void
     */
    public function test_sendResetLinkEmail() {
        Notification::fake();
        $user = factory(User::class)->create();
        $postFrom = '/password/reset';
        $response = $this->from($postFrom)->post('/password/email', [
            'email' => $user->email
        ]);

        # $postFrom へリダイレクト
        $response->assertRedirect($postFrom);

        # $userに対してパスワード再発行メールが送られている
        Notification::assertSentTo($user, ResetPassword::class);
    }
}
