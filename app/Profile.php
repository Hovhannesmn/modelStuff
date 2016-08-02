<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use Languages;
use Storage;

class Profile extends Model
{

    protected $fillable = ['name', 'confirmed', 'user_id', 'contact_email', 'cellphone', 'nationality', 'languages',
                        'age', 'weight', 'height', 'breast_number', 'breast_letter', 'haircolor', 'intimicy', 'smoke','drink',
        'about_short', 'about_full',  ];
    protected $casts = [
        'about_short' => 'array',
        'about_full' => 'array',
        'languages'  => 'array'
    ];


    
    public static function boot()
    {
        parent::boot();
        
        Profile::updated(function($profile)
        {   
            if($profile->user)
            {
                $profile->user->name = $profile->name;
                $profile->user->save();
            }
        });

        Profile::deleting(function($profile)
        {   
            foreach ($profile->allImages() as $image) {
                $image->delete();
            }
            $profile->services()->sync([]);
        });
    }

    public function schedules()
    {
    	return $this->hasMany('App\Schedule');
    }

    public function services()
    {
        
    	return $this->belongsToMany('App\Service');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->hasMany('App\ProfileImage', 'profile_id', 'id')->where('is_general', 0)->orderBy('order');
    }

    public function allImages()
    {
        return $this->hasMany('App\ProfileImage');
    }

    public function image()
    {
        return $this->hasOne('App\ProfileImage')->where('is_general', 1);
    }

    public function printLanguages()
    {
        $stringBegin = '<span style="text-transform: capitalize;">';
        $stringEnd = '</span>';

        if(is_array($this->languages))
        {
            return $stringBegin . implode($this->languages, $stringEnd.', '.$stringBegin);
        }

        return '';
    }
    
    public function hasService($id)
    {
    	foreach ($this->services as $service) {
    		if($service->id == $id)
    		{
    			return true;
    		}
    	}

    	return false;
    }
    
    

    public function availableHaircolors()
    {
        $strings = Languages::strings()['model']['haircolors'];
//        dd($strings);
        
        $translatedStrings = [];

        foreach ($strings as $key => $value) {

           $translatedStrings[$key] = Languages::trans('model.haircolors.'.$key); 
        }

        return $translatedStrings;
    }

    public function availableIntimicy()
    {
        $strings = Languages::strings()['model']['intimicy'];
        
        $translatedStrings = [];
        foreach ($strings as $key => $value) {
           $translatedStrings[$key] = Languages::trans('model.intimicy.'.$key); 
        }

        return $translatedStrings;
    }

    public function availableBNumber()
    {
        return [
            '60'  => '60',
            '65'  => '65',
            '70'  => '70',
            '75'  => '75',
            '80'  => '80',
            '85'  => '85',
            '90'  => '90',
            '95'  => '95',
            '100'  => '100',
            '105'  => '105',
            '110'  => '110',
        ];  
    }

    public function availableBLetter()
    {
        return [
            'A'  => 'A',
            'B'  => 'B',
            'C'  => 'C',
            'D'  => 'D',
            'E'  => 'E',
            'F'  => 'F',
            'G'  => 'G',
            'H'  => 'H',
            'I'  => 'I',
            'J'  => 'J',
        ];  
    }

    public function availableLanguages()
    {
        if(Storage::exists('langlist.json')){

            $languages = json_decode(Storage::get('langlist.json'), true);

            $languageStrings = [];

            foreach ($languages as $lang) {
               $languageStrings[$lang['nativeName']] = $lang['nativeName'];
            }

            return $languageStrings;
        }

        return [];
    }

    public function availableNationality()
    {
        if(Storage::exists('nationality.json')){
            $nationalities = json_decode(Storage::get('nationality.json'), true);
            $nationalityStrings = [];
            foreach ($nationalities as $nat) {
               $nationalityStrings[$nat] = $nat; 
            }
            return $nationalityStrings;
        }
        return [];
    }

    public function isWorkingDate($date = null)
    {
        if(!$date)
        {
            $date = Carbon::now()->format('Y-m-d');
        }
        $schedules = $this->schedules()->where('date_from', '<=', $date)->where('date_to', '>=', $date)->get();
        return $schedules->count() > 0;
    }

    public function getSmokeAttribute($value)
    {
        if($value == '1'){
            return 'Yes';
        }
        return 'No';
    }

    public function getDrinkAttribute($value)
    {
        if($value == '1'){
            return 'Yes';
        }
        return 'No';
    }

    public function scopeOfLocation($query, $location, $request)
    {
        if ($request->has('nationality')) {

            return  $query->where('nationality', $location );
        }
    }

    public function scopeOfAge($query, $age, $request)
    {
        if ($request->has('age')) {
            return  $query->where('age', $age );
        }
    }

    public function scopeOfName($query, $name, $request)
    {
        if ($request->has('name')) {
            return  $query->where('name', 'like', $name);
        }
    }

    public function scopeOfHaircolor($query, $haircolor, $request)
    {
        if ($request->has('haircolor')) {
            return  $query->where('haircolor', $haircolor );
        }
    }
    
    public function scopeOfBreast_number($query, $breast_number, $request)
    {
        if ($request->has('breast_number')) {
            return  $query->where('breast_number', $breast_number );
        }

    }

    public function scopeOfBreast_letter($query, $breast_letter, $request)
    {
        if ($request->has('breast_letter')) {

            return  $query->where('breast_letter', $breast_letter );
        }
    }

    public function scopeOfNo_picture($query, $no_picture, $request)
    {
        if ($request->has('no_picture')) {

            return
            $query->join('profile_images', 'profiles.id', '=',   'profile_images.profile_id' )
                ->groupBy('profile_images.url')
                ->whereNull( 'profile_images.url');

        }
    }

    public function scopeOfHas_picture($query, $has_picture, $request)
    {
        if ($request->has('has_picture')) {
            return
                $query->join('profile_images', 'profiles.id', '=',   'profile_images.profile_id' )
                    ->groupBy('profile_images.url')
                    ->whereNotNull( 'profile_images.profile_id');
        }
    }

    
}
