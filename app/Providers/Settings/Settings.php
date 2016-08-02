<?php 

namespace App\Providers\Settings;

use Storage;
use App;

class Settings{

	/**
     * Array of user defined settings
     *
     * @var array
     */
	protected $settings;

	protected $access;


	public function __construct(){
		$this->readFromFile();

		$this->readAccessConfiguration();
	}

 	protected function readFromFile(){

		if(Storage::exists('settings.json')){
			$settings = json_decode(Storage::get('settings.json'), true);
		}

		$this->settings = $settings;
 	}

 	protected function readAccessConfiguration()
 	{
 		$access = [];
 		if(Storage::exists('access.json')){
			$access = json_decode(Storage::get('access.json'), true);
		}
		$this->access = $access;
 	}

 	public function saveAccessConfiguration($array)
 	{
 		Storage::put('access.json', json_encode($array));
 	}

 	public function saveSettings($array){
		Storage::put('settings.json', json_encode($array));
 	}

 	public function save()
 	{
 		Storage::put('settings.json', json_encode($this->settings));
 	}

	/**
     * Return array of user defined settings
     *
     * @return array
     */
	public function all(){

		return $this->settings;
	}

	/**
     * Return value of user settings key
     * 
     * @param string $key
     * @return mixed
     */
	public function get($key){
		if(array_key_exists($key, $this->settings)){
			return $this->settings[$key];
		}
		return null;
	}

	public function set($key, $value){
		$this->settings[$key] = $value;
		$this->save();
	}


	/**
     * Return value of user settings key using selected translation
     * 
     * @param string $key
     * @return mixed
     */
	public function trans($key, $lang){

		if(array_key_exists($key, $this->settings)){
			if(array_key_exists($lang, $this->settings[$key]))
				return $this->settings[$key][$lang];
		}
		else{
			return null;
		}
	}

	public function localize($key)
	{
		$locale = App::getLocale();

		if($this->trans($key, $locale))
		{
			return $this->trans($key, $locale);
		}
		
		return $this->trans($key, $this->settings['default_locale']);
	}


	public function blockedByIp($ip)
	{
		if(array_key_exists('ip', $this->access))
		{
			return in_array($ip, $this->access['ip']);
		}

		return true;
	}

	public function blockedByCountry($country)
	{
		if(array_key_exists('country', $this->access))
		{
			return in_array($country, $this->access['country']);
		}

		return true;
	}

	public function hasBlockAccess()
	{
		if(array_key_exists('hasBlock', $this->access))
		{
			return (bool)$this->access['hasBlock'];
		}

		return false;
	}

	public function getBlockedIp()
	{
		return array_key_exists('ip', $this->access)?$this->access['ip']:[];
	}

	public function getBlockedCountries()
	{
		return array_key_exists('country', $this->access)?$this->access['country']:[];
	}
}