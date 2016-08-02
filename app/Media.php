<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function getUrlAttribute($value)
    {
    	return url($value);
    }
}
