<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class UserTest extends TestCase
{
    public function tearDown() {
        Mockery::close();
    }

    /**
     * has many members
     */
    public function test_members() {
        // mock
        $user = Mockery::mock('App\User')->makePartial();
        $members = Mockery::mock('Illuminate\Database\Eloquent\Collection');
        $user
            ->shouldReceive('hasMany')
            ->with('App\Member')
            ->times(1)
            ->andReturn($members);

        // assert
        $this->assertEquals($members, $user->members());
    }

    /**
     * belongs to many clubs
     */
    public function test_clubs() {
        // mock
        $user = Mockery::mock('App\User')->makePartial();
        $clubs = Mockery::mock('Illuminate\Database\Eloquent\Collection');
        $user
            ->shouldReceive('belongsToMany')
            ->with('App\Club', 'members')
            ->times(1)
            ->andReturn($clubs);
        $clubs
            ->shouldReceive('withTimestamps')
            ->times(1)
            ->andReturn($clubs);

        // assert
        $this->assertEquals($clubs, $user->clubs());
    }
}
