<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phonenumber','lovehouse','confirmed', 'confirmation_code', 'lovehouse_id' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */ 
    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();
        
        User::updated(function($user)
        {   
            if($user->profile)
            {
                $user->profile->name = $user->name;
                $user->profile->save();
            }
        });

        User::deleting(function($user)
        {   
            if($user->profile)
            {
                $user->profile->delete();
            }
        });
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function lovehouse()
    {
        return $this->hasOne('App\Lovehouse', 'user_id', 'id');
    }
    public function favorite()
    {
        return $this->hasMany('App\Favorite', 'login_id', 'id');
    }

    public function rolesId(){
        $ids = [];

        foreach($this->roles as $role)
        {
            $ids[] = $role->id;
        }

        return $ids;
    }

    public function hasRole($key){
        foreach ($this->roles as $role) {
            if($role->name == $key)
                return true;
        };

        return false;
    }
    
    public function getip()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        return $realip;
    }
}
