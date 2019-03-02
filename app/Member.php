<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_type'
    ];

    /**
     * ROLE_TYPE
     */
    const ROLE_TYPE = [
        'member'        => 1,
        'manager'       => 2
    ];

    /**
     * belongs to club
     */
    public function club() {
        return $this->belongsTo('App\Club');
    }

    /**
     * belongs to user
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
