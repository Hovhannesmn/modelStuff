<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Jobmarket extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobmarkets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'image', 'address', 'contuct_number', 'offer_id', 'condition_id', 'user_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static function availableCondition()
    {
        return [
            'wifi'  => 'WIFI',
             'wlan' => 'W-LAN',
             'tv'   =>  'TV',
        ];
    }

    public function hasService($id)
    {
        foreach ($this->conditions as $condition) {
            if($condition->id == $id)
            {
                return true;
            }
        }

        return false;
    }

    public function conditions()
    {

        return $this->belongsToMany('App\Condition');
    }

    public function __construct(array $attributes)
    {

    }


}
