<?php 

namespace App\Providers\Theme;

use App;
use Languages;
use Storage;
use Settings;

class Theme{

	protected $path;
	protected $all;

	protected $active;

	protected $settings;
	
	public function __construct()
	{
		$this->path = base_path('resources/views/themes');

		$this->all = array_values(array_diff(scandir($this->path), array('..', '.')));

		$this->active = Settings::get('active_theme');

		if(!file_exists($this->path.'/'.$this->active))
		{
			$this->active = $this->all[0];
		}

		$this->settings = [];
		if(Storage::exists('theme_'.$this->active.'.json')){
			$this->settings = json_decode(Storage::get('theme_'.$this->active.'.json'), true);
		}
 	}

	public function all()
	{
		return $this->all;
	}

	public function allNotActive()
	{
		$ret = $this->all;
		if(($key = array_search($this->active, $ret)) !== false) {
		    unset($ret[$key]);
		}
		return $ret;
	}

	public function active()
	{
		return $this->active;
	}

	public function config($slug = null)
	{
		if(!$slug)
		{
			$slug = $this->active;
		}
		return require($this->path.'/'.$slug.'/theme.php');
	}

	public function getImage($themeSlug = null)
	{
		if(!$themeSlug)
		{
			$themeSlug = $this->active['slug'];
		}

		if(in_array($themeSlug, $this->all))
		{
			//Theme folder exist
			$file = $this->path . '/' . $themeSlug . '/screen.jpg';
			if(file_exists($file))
			{
				$contents = file_get_contents($file);
  				$base64   = base64_encode($contents); 
  				return ('data:image/png;base64,' . $base64);
			}
			else
			{
				return '';
			}
		}
	}

	public function areas($type = 'array')
	{
		$config = $this->config();
		$ret = $config['navigation'];

		if($type == 'json')
		{
			return json_encode(array_values($ret));
		}
		if($type == 'kv')
		{
			$arr = [];
			foreach ($ret as $key => $item) {
				$arr[$key] = $item['name'];
			}
			return $arr;
		}
		return $ret;
	}

	public function templates()
	{
		$config = $this->config();
		$arr = [];
		foreach ($config['templates'] as $key => $value) {
			$arr[$key] = $value['name'];
		}
		return $arr;
	}

	public function options()
	{
		return $this->config()['options'];
	}

	public function option($name)
	{
		foreach ($this->options() as $value) {
			if($value['name'] == $name)
			{
				return $value;
			}
		}
		return null;
	}

	public function render($page)
	{
		$templateKey = array_key_exists('template', $page->settings)?$page->settings['template']:'default';
		return view($this->templatePath($templateKey))->with('page', $page);
	}

	public function showProfile($profile)
	{
		return view('themes.'.$this->active().'.templates.profile')->with('profile', $profile);
	}

	public function templatePath($templateKey)
	{	
		$c = $this->config();
		$t = 'page';
		if(array_key_exists($templateKey, $c['templates']))
		{
			$t = $c['templates'][$templateKey]['file'];
		}
		return 'themes.'.$this->active().'.templates.'.$t;
	}

	//Return settings option
	public function s($name)
	{
		if(array_key_exists($name, $this->settings))
		{
			return $this->settings[$name];
		}
		return null;
	}

	//Return is settings option enabled field equal to 1
	public function sOn($name)
	{
		$o = $this->option($name);
		if(is_array($o))
		{
			if(!array_key_exists('optional', $o))
				return true;

			if($o['optional'] == 'no')
				return true;
		}
		if(array_key_exists($name, $this->settings))
		{
			if(!is_array($this->settings[$name]))
			{
				return false;
			}
			if(array_key_exists('enabled', $this->settings[$name]))
			{
				return $this->settings[$name]['enabled'] == '1';
			}
		}
		return false;
	}

	//Return settings option value
	public function sValue($name)
	{
		if(array_key_exists($name, $this->settings))
		{
			if(!is_array($this->settings[$name]))
			{
				return $this->settings[$name];
			}
			if(array_key_exists('value', $this->settings[$name]))
			{
				return $this->settings[$name]['value'];
			}
		}
		return null;
	}

	public function getSetting($name)
	{
		if($this->sValue($name) && $this->sOn($name))
		{
			$c = $this->option($name);
			if($c)
			{
				if($c['type'] == 'image')
				{
					return App\Media::find($this->sValue($name));
				}
				if($c['type'] == 'profile')
				{
					return App\Profile::find($this->sValue($name));
				}
			}
		}
		return null;
	}

	//save array of settings options
	public function save($settings)
	{
		Storage::put('theme_'.$this->active.'.json', json_encode($settings));
	}

	//Render page title
	public function pageTitle($page)
	{
		if($page->meta_title)
		{
			return $page->meta_title;
		}

		return strip_tags(Settings::localize('website_name') . ' - ' . $page->title);
	}

	//Clean content output
	public function content($html)
	{
		return $html;
	}

	//Create url
	public function url($url)
	{
		if(App::getLocale() == Languages::general())
		{
			return url($url);
		}

		if($url == '/')
		{ 
			$url = '';
		}

		return url(App::getLocale().'/'.$url);
	}

	public function template($name = 'default')
	{	
		$c = $this->config();
		if(array_key_exists($name, $c['templates']))
		{
			return new Template($c['templates'][$name]);
		}
		return new Template();
	}
}