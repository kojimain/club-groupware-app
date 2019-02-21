<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /**
     * ページが表示されること
     *
     * @return void
     */
    public function test_ページが表示される()
    {
        // TOP
        $response = $this->get('/');
        $response->assertStatus(200);
        // 存在しないページ
        $response = $this->get('/notexistingpage');
        $response->assertStatus(200);
    }
}
