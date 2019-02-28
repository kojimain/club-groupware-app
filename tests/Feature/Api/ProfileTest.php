<?php

namespace Tests\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET /api/profile
     *
     * App\Http\Controllers\Api\ProfileController@show
     *
     * @return void
     */
    public function test_show()
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // GET送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('GET', '/api/profile');

        // 200返す
        $response->assertStatus(200);
        // 所定のJSON値が返る
        $response->assertJson([
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    /**
     * POST /api/profile
     *
     * App\Http\Controllers\Api\ProfileController@update
     *
     * @param string name
     * @param string email
     * @dataProvider provideUpdateParams
     * @return void
     */
    public function test_update($status, $params)
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // POST送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('POST', '/api/profile', $params);

        $response->assertStatus($status);
    }

    /**
     * dataProvider updateParams
     */
    public function provideUpdateParams()
    {
        return [
            // valid
            [200, ['name' => 'validname', 'email' => 'validemail@example.com']],
            // invalid
            [422, ['name' => '', 'email' => 'validemail@example.com']],                         // nameが0文字
            [422, ['name' => str_repeat('n', 256), 'email' => 'validemail@example.com']],       // nameが256文字
            [422, ['name' => 'validname', 'email' => '']],                                      // emailが0文字
            [422, ['name' => 'validname', 'email' => str_repeat('n', 244).'@example.com']],     // emailが256文字
            [422, ['name' => 'validname', 'email' => 'メアドじゃない']],                          // emailが非メアド
        ];
    }
}
