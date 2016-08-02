<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Languages;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'meta_title', 'meta_keywords', 'meta_description', 'settings'];

    protected $casts = [
        'settings' => 'array',
        'content' => 'array'
    ];

    public function translations()
    {
    	return $this->hasMany('App\PageTranslation');
    }

    public function translation($lang)
    {
        if($lang == Languages::general())
        {
            return $this;
        }

        foreach ($this->translations as $translation) {
            if($translation->language == $lang)
            {
                $page = new Page();

                $page->title = $translation->title;
                $page->slug = $this->slug;
                $page->content = $translation->content;
                $page->settings = $translation->settings;
                $page->meta_title = $translation->meta_title;
                $page->meta_keywords = $translation->meta_keywords;
                $page->meta_description = $translation->meta_description;

                return $page;
            }
        }

        return $this;
    }

    public function translatedTo($lang)
    {
    	if($lang == Languages::general())
    	{
    		return true;
    	}

    	foreach ($this->translations as $translation) {
    		if($translation->language == $lang)
    		{
    			return true;
    		}
    	}

    	return false;
    }

    public function setting($key)
    {
        if(!is_array($this->settings))
        {
            return null;
        }
        
        if(array_key_exists($key, $this->settings))
        {
            return $this->settings[$key];
        }
        return null;
    }

    public static function allIdKey()
    {
        $arr = [];
        foreach (Page::all() as $page) {
            $arr[$page->id] = $page->title;
        }
        return $arr;
    }

    public static function titles()
    {
        $arr = [];
        foreach (Page::all() as $page) {
            $arr_inner = [];

            foreach (Languages::all() as $lang) {
                if($page->translatedTo($lang))
                {
                    $trans = $page->translation($lang);
                    $arr_inner[] = [
                        'lang' => $lang,
                        'title' => $trans->title
                    ]; 
                    continue;
                }
                $arr_inner[] = [
                    'lang' => $lang,
                    'title' => $page->title
                ]; 
            }

            $arr[$page->id] = $arr_inner;
        }
        return $arr;
    }

    public function content($area = 'general')
    {
        if(array_key_exists($area, $this->content))
        {
            return $this->content['area'];
        }
        return '';
    }
}
