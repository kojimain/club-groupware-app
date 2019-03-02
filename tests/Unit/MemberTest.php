<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Member;

class MemberTest extends TestCase
{
    public function tearDown() {
        Mockery::close();
    }


    /**
     * const ROLE_TYPE
     */
    public function test_const_ROLE_TYPE() {
        $this->assertEquals(
            Member::ROLE_TYPE,
            [
                'member'        => 1,
                'manager'       => 2
            ]
        );
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
