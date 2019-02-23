<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use App\User;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET /password/reset/{token}
     *
     * App\Http\Controllers\Auth\ResetPasswordController@showResetForm
     *
     * @return void
     */
    public function test_showResetForm()
    {
        $user = factory(User::class)->create();
        $token = Password::broker()->createToken($user);

        // アクセス
        $response = $this->get('/password/reset/'.$token);

        // 200返す
        $response->assertStatus(200);
    }

    /**
     * POST /password/reset
     *
     * App\Http\Controllers\Auth\ResetPasswordController@reset
     *
     * @return void
     */
    public function test_reset()
    {
        $user = factory(User::class)->create();
        $token = Password::broker()->createToken($user);

        // POSTする
        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ]);

        // 200返す
        $response->assertRedirect('/');
    }
}
