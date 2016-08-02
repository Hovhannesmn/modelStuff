<?php 

namespace App\Providers\Languages;

use Storage;

use Settings;
use Request;

class Languages{

	/**
     * Array of existing languages
     *
     * @var array
     */
	protected $langs;

	/**
     * Array of strings defaults
     *
     * @var array
     */
	protected $strings;

	/**
     * Array of strings translations
     *
     * @var array
     */
	protected $translations;

	/**
     * Current request locale
     *
     * @var string
     */
	protected $locale;

	/**
     * Fallback locale (used when current locale not founded)
     *
     * @var string
     */
	protected $generalLocale;


	public function __construct(){
		$this->readFromFile();
	}

	protected function readFromFile(){

		if(Storage::exists('languages.json')){

			$languages = json_decode(Storage::get('languages.json'), true);

		}else{
			//Create new languages file that contain at least one default language
		}

		$this->langs = $languages;

		$translations = [];
		if(Storage::exists('translations.json')){

			$translations = json_decode(Storage::get('translations.json'), true);

		}

		$this->translations = $translations;

		$this->strings = config('langstrings');



		$this->generalLocale = Settings::get('default_locale');
		$this->locale = Settings::get('default_locale');
 	}

	public function saveLanguages($array){

		Storage::put('languages.json', json_encode($array));

		return '1';
	}

	public function saveStrings($array){
		Storage::put('translations.json', json_encode($array));
	}

 	/**
     * Return an general (fallback) locale for website
     *
     * @return string
     */
	public function general(){
		
		return $this->generalLocale;
	}

 	/**
     * Return an locale for current session request 
     *
     * @return string
     */
	public function locale(){
		
		return $this->locale;
	}

	/**
     * Return array of user defined languages
     *
     * @param  string 	$format short(only lang code) / full(array of lang info)
     * @return array
     */
	public function all($format = 'short', $includeDefault = true){

		$langs = $this->langs;

		if($format == 'full'){
			return $langs;
		}

		//Return just lang codes
		$codes = [];
		foreach ($langs as $lang) {
			$codes[$lang['code']] = $lang['code'];
		}

		if(!$includeDefault){
			unset($codes[$this->generalLocale]);
		}
		return $codes;
	}

	/**
     * Return array of user defined languages excluding general language 
     *
     * @param  string 	$format short(only lang code) / full(array of lang info)
     * @return array
     */
	public function allButGeneral(){
		return $this->all('short', false);
	}


	public function flags(){
		$flagsDirectory = public_path() . '/build/assets/admin/flags/4x3';

		$output = [];

		foreach ( array_diff(scandir($flagsDirectory), array('..', '.')) as $value ){
			$output[] = str_replace('.svg', '', $value);
		}

		return $output;
	}

	public function flagUrl($lang)
	{	
		$flag = null;
		foreach ($this->langs as $langObj) {
			if($langObj['code'] == $lang)
			{
				return url('/build/assets/admin/flags/4x3/'.$langObj['flag'].'.svg');
			}
		}
		return '';
	}

	public function strings(){

		return $this->strings;
	}

	protected function defaultTrans($keys){

		$source = $this->strings;
		if(count($keys) >= 2){
			if(array_key_exists($keys[0], $source)){
				if(array_key_exists($keys[1], $source[$keys[0]])){
					if(array_key_exists($keys[2], $source[$keys[0]][$keys[1]])){
						return $source[$keys[0]][$keys[1]][$keys[2]];
					}
				}
			}
		}
		return null;
	}

	public function trans($path, $locale = null){

		if(!$locale){
			$locale = $this->locale;
		}

		$transKey = str_replace('.', '_', $path);
		if(array_key_exists($transKey, $this->translations)){
			if(array_key_exists($locale, $this->translations[$transKey])){

				return $this->translations[$transKey][$locale];
			}
			if(array_key_exists($this->generalLocale, $this->translations[$transKey])){
				return $this->translations[$transKey][$this->generalLocale];
			}
		}
		return $this->defaultTrans(explode('.', $path));
	}

	public function fromArray($data, $locale = null){

		if(!$locale){
			$locale = $this->locale;
		}

		if(array_key_exists($locale, $data)){
			return $data[$locale];
		}

		return $this->trans('general.labels.not_translated');
	}

	public function fromArrayOrNull($data, $locale = null){

		if(!$locale){
			$locale = $this->locale;
		}

		if(!is_array($data))
		{
			return null;
		}

		if(array_key_exists($locale, $data)){
			return $data[$locale];
		}

		return null;
	}

	public function fromArrayOrFallback($data, $locale = null)
	{
		$translation = $this->fromArrayOrNull($data);
		if(!$translation)
		{
			$translation = $this->fromArrayOrNull($data, $this->general());
		}
		return $translation;
	}

	public function name($code)
	{
		foreach ($this->langs as $lang) {
			if($lang['code'] == $code)
			{
				return $lang['name'];
			}
		}

		return null;
	}


	public function localizeUrl($locale, $url = null)
	{
		if(!$url)
		{
			$url = Request::fullUrl();
		}

		$url = str_replace(Request::root().'/', '' , $url);
		$url = str_replace(Request::root(), '' , $url);

		if(in_array($url, $this->all()))
		{
			$url .= '/';
		}

		$langReplacement = [];
		foreach ($this->all() as $lang) {
			$langReplacement[] = $lang.'/';
		}
		$url = str_replace($langReplacement, '', $url);

		$replacement = '/';
		if($this->general() != $locale)
		{
			$replacement = '/'.$locale.'/';
		}

		return Request::root().$replacement.$url;
	}
}