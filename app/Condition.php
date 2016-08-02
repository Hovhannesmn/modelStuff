<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Languages;

class Condition extends Model
{	
	protected $fillable = ['slug', 'name'];

	protected $casts = [
        'name' => 'array',
    ];

    public function jobmarket()
    {
    	return $this->belongsToMany('App\Jobmarket');
    }


}
