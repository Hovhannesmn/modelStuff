<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    public static function boot()
    {
        parent::boot();

        ProfileImage::deleting(function($profileImage)
        {   
            $url = $profileImage->getOriginal('url');
            if(file_exists(public_path($url))){
                unlink(public_path($url));
            }
        });
    }

    public function getUrlAttribute($value)
    {
    	return url($value);
    }
}
