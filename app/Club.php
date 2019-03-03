<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
    ];

    /**
     * has many members
     */
    public function members() {
        return $this->hasMany('App\Member');
    }

    /**
     * belongs to many users
     */
    public function users() {
        return $this
            ->belongsToMany('App\User', 'members')
            ->withTimestamps();
    }
}
