<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Languages;

class Service extends Model
{	
	protected $fillable = ['slug', 'name'];

	protected $casts = [
        'name' => 'array',
    ];

    public function profiles()
    {
    	return $this->belongsToMany('App\Profile');
    }

    public function printName($locale = null)
    {
    	if(!$locale){
			$locale = Languages::locale();
		}

		if(array_key_exists($locale, $this->name)){
			return $this->name[$locale];
		}

		if(array_key_exists(Languages::general(), $this->name)){
			return $this->name[Languages::general()];
		}

		return ucfirst($this->slug);
    }

    public function printNameIfTrans($locale = null)
    {
    	if(!$locale){
			$locale = Languages::locale();
		}

		if(array_key_exists($locale, $this->name)){
			return $this->name[$locale];
		}

		return Languages::trans('general.labels.not_translated');
    }
}
