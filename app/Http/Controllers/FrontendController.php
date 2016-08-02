<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App;
use App\Page;
use Theme;
use Languages;
use Settings;
use Request;

class FrontendController extends Controller
{
    public function home()
    {
    	App::setLocale(Languages::general());

        $home_id = Theme::sValue('homepage');
        $page = Page::findOrFail($home_id)->translation(App::getLocale());


        return Theme::render($page);
    }

    public function page($p1, $p2 = '/')
    {
    	$lang = Languages::general();
		$page = $p1;

		if(in_array($p1, Languages::all()))
		{
			$lang = $p1;
			$page = $p2;
		}
		else if($p2 != '/')
		{
			App::abort(404);
		}

		App::setLocale($lang);	
		if($page == '/')
		{
			$page = Page::findOrFail(Theme::sValue('homepage'))->translation(App::getLocale());
		}
		else if(Settings::get('website_type') == 'c' && $page == 'girl')
		{
			$profile = App\Profile::find(Request::input('id'));

			return Theme::showProfile($profile);
		}
		else
		{
			$pageQuery = Page::where('slug', $page)->first();
			if($pageQuery)
			{
				if($pageQuery->translatedTo($lang))
				{
					$page = $pageQuery->translation(App::getLocale());
				}
				else
				{
					$page = $pageQuery;
				}
			}
			else
			{
				App::abort(404);
			}
		}
		return Theme::render($page);
    }
}
