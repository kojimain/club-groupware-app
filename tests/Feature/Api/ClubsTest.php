<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Member;
use App\Club;

class ClubsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET /api/clubs
     *
     * App\Http\Controllers\Api\ClubsController@index
     */
    public function test_index()
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // memberのROLE_TYPEごとにclubとmemberを複数用意
        foreach (Member::ROLE_TYPE as $role_type) {
            $club = factory(Club::class)->make();
            $user->clubs()->save(
                $club,
                [
                    'role_type' => $role_type
                ]
            );
        }

        // GET送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('GET', '/api/clubs');

        // 200が返る
        $response->assertStatus(200);

        // 所定のJSONが返る
        $response->assertExactJson($user->clubs()->get()->toArray());
    }

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

    /**
     * PUT/PATCH /api/clubs/{club} パラメータが正当なとき
     *
     * App\Http\Controllers\Api\ClubsController@update
     *
     * @dataProvider provideValidUpdateParams
     */
    public function test_update_whenValid($status, $params)
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // club用意
        $clubwas = factory(Club::class)->make([
            'name' => 'clubnamebeforechange'
        ]);
        $user->clubs()->save(
            $clubwas,
            [
                'role_type' => Member::ROLE_TYPE['manager']
            ]
        );

        // PATCH送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('PATCH', '/api/clubs/'.$clubwas->id, $params);
        $club = $user->clubs()->first();

        // 期待したHTTPステータスが返る
        $response->assertStatus($status);

        // 属性が更新されている
        $this->assertEquals($params['name'], $club->name);

        // 所定のJSONが返る
        $response->assertExactJson([
            'id' => $club->id,
            'name' => $club->name,
            'created_at' => $club->created_at->toDateTimeString(),
            'updated_at' => $club->updated_at->toDateTimeString(),
        ]);
    }

    /**
     * dataProvider provideValidUpdateParams
     */
    public function provideValidUpdateParams()
    {
        return [
            [200, ['name' => 'validname']],
        ];
    }

    /**
     * PUT/PATCH /api/clubs/{club} パラメータが不当なとき
     *
     * App\Http\Controllers\Api\ClubsController@update
     *
     * @dataProvider provideInvalidUpdateParams
     */
    public function test_update_whenInvalid($status, $params)
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // club用意
        $clubwas = factory(Club::class)->make([
            'name' => 'clubnamebeforechange'
        ]);
        $user->clubs()->save(
            $clubwas,
            [
                'role_type' => Member::ROLE_TYPE['manager']
            ]
        );

        // PATCH送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('PATCH', '/api/clubs/'.$clubwas->id, $params);
        $club = $user->clubs()->first();

        // 期待したHTTPステータスが返る
        $response->assertStatus($status);

        // 属性が更新されていない
        $this->assertNotEquals($params['name'], $club->name);
    }

    /**
     * dataProvider provideInvalidUpdateParams
     */
    public function provideInvalidUpdateParams()
    {
        return [
            [422, ['name' => '']],
            [422, ['name' => str_repeat('n', 256)]],
        ];
    }

    /**
     * GET /api/clubs/{club}
     *
     * App\Http\Controllers\Api\ClubsController@show
     */
    public function test_show()
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // club用意
        $club = factory(Club::class)->make([
            'name' => 'clubnamebeforechange'
        ]);
        $user->clubs()->save(
            $club,
            [
                'role_type' => Member::ROLE_TYPE['manager']
            ]
        );

        // GET送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('GET', '/api/clubs/'.$club->id);

        // 200が返る
        $response->assertStatus(200);

        // 所定のJSONが返る
        $response->assertExactJson([
            'id' => $club->id,
            'name' => $club->name,
            'created_at' => $club->created_at->toDateTimeString(),
            'updated_at' => $club->updated_at->toDateTimeString(),
        ]);
    }

    /**
     * DELETE /api/clubs/{club} クラブがユーザ管理下のとき
     *
     * App\Http\Controllers\Api\ClubsController@destroy
     */
    public function test_destroy_managedClub()
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // manager権限でclub用意
        $club = factory(Club::class)->make([]);
        $user->clubs()->save(
            $club,
            [
                'role_type' => Member::ROLE_TYPE['manager']
            ]
        );

        // DELETE送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('DELETE', '/api/clubs/'.$club->id);

        // 200が返る
        $response->assertStatus(200);

        // clubが削除されている
        $this->assertDatabaseMissing('clubs', []);
        // memberが削除されている
        $this->assertDatabaseMissing('members', []);
    }

    /**
     * DELETE /api/clubs/{club} クラブがユーザ管理下でないとき
     *
     * App\Http\Controllers\Api\ClubsController@destroy
     */
    public function test_destroy_notManagedClub()
    {
        // user用意
        $user = factory(User::class)->create();
        $user->refleshApiToken();

        // member権限でclub用意
        $club = factory(Club::class)->make([]);
        $user->clubs()->save(
            $club,
            [
                'role_type' => Member::ROLE_TYPE['member']
            ]
        );

        // DELETE送信
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$user->api_token
            ])
            ->json('DELETE', '/api/clubs/'.$club->id);

        // 404が返る
        $response->assertStatus(404);

        // clubが削除されていない
        $this->assertDatabaseHas('clubs', []);
        // memberが削除されていない
        $this->assertDatabaseHas('members', []);
    }
}
