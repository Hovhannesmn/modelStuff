<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    static public function allwithkeys()
    {
    	$roles = [];
    	foreach( Role::all() as $role ){
    		$roles[$role->id] = $role->name;
    	}

    	return $roles;
    }
}
