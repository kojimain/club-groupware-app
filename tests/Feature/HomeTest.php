<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class HomeTest extends TestCase
{
    /**
     * GET /{any?} ログインしていない場合
     *
     * App\Http\Controllers\HomeController@index
     * ログインしていない場合、/login にリダイレクトされる
     *
     * @return void
     */
    public function test_index_when_loggedOut()
    {
        $this->get('/')
            ->assertRedirect('/login');
        $this->get('/somewhere')
            ->assertRedirect('/login');
    }

    /**
     * GET /{any?} ログイン済みの場合
     *
     * App\Http\Controllers\HomeController@index
     * ログイン済みの場合、200で表示される
     *
     * @return void
     */
    public function test_index_when_loggedIn() {
        // ログインする
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get('/')
            ->assertStatus(200);
        $this->get('/somewhere')
            ->assertStatus(200);
    }
}
