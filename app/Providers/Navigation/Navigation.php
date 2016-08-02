<?php 

namespace App\Providers\Navigation;

use Storage;
use App;

use App\Page;

use Request;
use Languages;
use Settings;
use Theme;

class Navigation{

	/**
     * Array of user defined navigation anchors
     *
     * @var array
     */
	protected $navigation;


	public function __construct(){
		$this->readFromFile();
	}

 	protected function readFromFile(){
 		$navigation = [];

		if(Storage::exists('navigation.json')){

			$navigation = json_decode(Storage::get('navigation.json'), true);

		}

		$this->navigation = $navigation;
 	}

 	public function save($array){

		Storage::put('navigation.json', json_encode($array));
 	}

	/**
     * Return array of user added links
     *
     * @return array
     */
	public function all(){

		return $this->navigation;
	}

	/**
     * Return array of user added links for selected area
     *
     * @return array
     */
	public function area($area)
	{
		$ret = [];
		foreach ($this->navigation as $link) {
			if($link['area'] == $area)
			{
				$ret[] = $link;
			}
		}
		return $ret;
	}

	public static function title($item)
	{
		if(!is_array($item))
		{
			return '';
		}

		$locale = App::getLocale();

		if(array_key_exists('title', $item))
		{
			if(array_key_exists($locale, $item['title']))
			{
				return $item['title'][$locale];
			}
		}
		return '';
	}

	public function link($item)
	{
		if(!is_array($item))
		{
			return '';
		}

		if($item['type'] == 'external'){
			return $item['value'];
		}

		$locale = App::getLocale();
		if(is_numeric($item['value']))
		{
			$page = Page::find($item['value']);
			if($page)
			{
				$slug = $page->slug;
				if(Theme::sValue('homepage') == $page->id)
				{
					$slug = '';
				}

				return Languages::localizeUrl($locale, Request::root().'/'.$slug);
			}
		}
	}
}