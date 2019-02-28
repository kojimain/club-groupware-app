<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * api_tokenの値を更新
     *
     * @return void
     */
    public function refleshApiToken() {
        $this
            ->forceFill(['api_token' => base64_encode(random_bytes(100))])
            ->save();
    }

    /**
     * has many members
     */
    public function members() {
        return $this->hasMany('App\Member');
    }

    /**
     * belongs to many clubs
     */
    public function clubs() {
        return $this
            ->belongsToMany('App\Club', 'members')
            ->withTimestamps();
    }
}
