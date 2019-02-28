<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class MemberTest extends TestCase
{
    public function tearDown() {
        Mockery::close();
    }

    /**
     * belongs to club
     */
    public function test_club() {
        // mock
        $member = Mockery::mock('App\Member')->makePartial();
        $club = Mockery::mock('App\Club');
        $member
            ->shouldReceive('belongsTo')
            ->with('App\Club')
            ->times(1)
            ->andReturn($club);

        // assert
        $this->assertEquals($club, $member->club());
    }

    /**
     * belongs to user
     */
    public function test_user() {
        // mock
        $member = Mockery::mock('App\Member')->makePartial();
        $user = Mockery::mock('App\User');
        $member
            ->shouldReceive('belongsTo')
            ->with('App\User')
            ->times(1)
            ->andReturn($user);

        // assert
        $this->assertEquals($user, $member->user());
    }
}
