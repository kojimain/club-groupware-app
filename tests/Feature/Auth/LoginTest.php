<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * ページが表示されること
     *
     * @return void
     */
    public function test_ページが表示される()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
