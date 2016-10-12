<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
    * Assign a stand to a user
    *
    * @param @stand - Stand they created.
    */
    public function stand()
    {
        return $this->hasOne('App\Stand');
    }

    public function hasStand()
    {
        return (bool)count($this->stand);
    }

    public function standRoute()
    {
        return '/stand/'.$this->stand->id;
    }

    public function address()
    {
        return $this->hasOne('App\UserAddress');
    }
}
