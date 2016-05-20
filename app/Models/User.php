<?php

namespace App\Models;

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
     * Set the user's first name.
     *
     * @param  string  $value
     * @return string
     */
   /* public function setFirstNameAttribute($value)
    {
   use Hash
   Hash::make($request->newPassword)
        $this->attributes['first_name'] = strtolower($value);
    }*/
}
