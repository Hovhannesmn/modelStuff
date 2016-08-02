<?php 

namespace App\Providers\Theme;

use App;
use Languages;
use Storage;
use Settings;

class Template{

	public $name;
	public $file;
	private $options;
	private $content;

	private $page;

	public function __construct($config = array())
	{
		if(array_key_exists('name', $config))
		{
			$this->name = $config['name'];
		}
		if(array_key_exists('file', $config))
		{
			$this->file = $config['file'];
		}
		if(array_key_exists('options', $config))
		{
			$this->options = $config['options'];
		}
		if(array_key_exists('content', $config))
		{
			$this->content = $config['content'];
		}
	}

	public function forPage($page)
	{
		$this->page = $page;
		return $this;
	}

	public function content($area = 'general')
	{
		if(!$this->page)
			return '';
		
		if(!is_array($this->page->content))
			return '';
		if(array_key_exists($area, $this->page->content))
		{
			return $this->page->content[$area];
		}
		return '';
	}

	public function contentAreas()
	{
		if(is_array($this->content))
			return $this->content;

		return array();
	}

	public function optionsSettings()
	{
		if(is_array($this->options))
			return $this->options;

		return array();
	}

	public function optionValue($name)
	{
		if(!$this->page)
			return null;

		if(is_array($this->options) && is_array($this->page->settings))
		{
			if(array_key_exists($name, $this->options) && array_key_exists($name, $this->page->settings))
			{
				if($this->page->settings[$name] != '0')
					return $this->page->settings[$name];
			}
		}

		return null;
	}

	public function getList($object = null)
	{
		$ret = array();
		$ret[0] = 'Select option ...';

		if($object)
		{
			if($object == 'slider')
			{
				foreach (App\Slider::all() as $slider) {
					$ret[$slider->id] = $slider->title;
				}
			}
			if($object == 'gallery')
			{
				foreach (App\Gallery::all() as $gallery) {
					$ret[$gallery->id] = $gallery->title;
				}
			}
		}

		return $ret;
	}

}