<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class ClubTest extends TestCase
{
    public function tearDown() {
        Mockery::close();
    }

    /**
     * has many members
     */
    public function test_members() {
        // mock
        $club = Mockery::mock('App\Club')->makePartial();
        $members = Mockery::mock('Illuminate\Database\Eloquent\Collection');
        $club
            ->shouldReceive('hasMany')
            ->with('App\Member')
            ->times(1)
            ->andReturn($members);

        // assert
        $this->assertEquals($members, $club->members());
    }

    /**
     * belongs to many users
     */
    public function test_users() {
        // mock
        $club = Mockery::mock('App\Club')->makePartial();
        $users = Mockery::mock('Illuminate\Database\Eloquent\Collection');
        $club
            ->shouldReceive('belongsToMany')
            ->with('App\User', 'members')
            ->times(1)
            ->andReturn($users);
        $users
            ->shouldReceive('withTimestamps')
            ->times(1)
            ->andReturn($users);

        // assert
        $this->assertEquals($users, $club->users());
    }
}
