<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Lovehouse extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lovehouses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description', 'location'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */ 

}