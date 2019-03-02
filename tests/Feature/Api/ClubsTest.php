<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Member;

class ClubsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * POST /api/clubs パラメータが正当なとき
     *
     * App\Http\Controllers\Api\ClubsController@store
     *
     * @dataProvider provideValidStoreParams
     */
    public function test_store_whenValid($status, $params)
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // POST送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('POST', '/api/clubs', $params);

        // 期待したHTTPステータスが返る
        $response->assertStatus($status);

        // clubが作成されている
        $club = $user->clubs->first();
        $this->assertNotNull($club);
        $this->assertEquals($params['name'], $club->name);

        // memberがmanager権限で作成されている
        $member = $user->members->first();
        $this->assertNotNull($member);
        $this->assertEquals(Member::ROLE_TYPE['manager'], $member->role_type);

        // 所定のJSONが返る
        $response->assertExactJson([
            'id' => $club->id,
            'name' => $club->name,
            'created_at' => $club->created_at->toDateTimeString(),
            'updated_at' => $club->updated_at->toDateTimeString(),
        ]);
    }

    /**
     * dataProvider provideValidStoreParams
     */
    public function provideValidStoreParams()
    {
        return [
            [201, ['name' => 'validname']],
        ];
    }

    /**
     * POST /api/clubs パラメータが不当なとき
     *
     * App\Http\Controllers\Api\ClubsController@store
     *
     * @dataProvider provideInvalidStoreParams
     */
    public function test_store_whenInvalid($status, $params)
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // POST送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('POST', '/api/clubs', $params);

        // 期待したHTTPステータスが返る
        $response->assertStatus($status);

        // clubが作成されていない
        $club = $user->clubs->first();
        $this->assertNull($club);

        // memberが作成されていない
        $member = $user->members->first();
        $this->assertNull($member);
    }

    /**
     * dataProvider provideInvalidStoreParams
     */
    public function provideInvalidStoreParams()
    {
        return [
            [422, ['name' => '']],
            [422, ['name' => str_repeat('n', 256)]],
        ];
    }
}
