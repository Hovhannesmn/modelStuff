<?php 

namespace App\Providers\Contacts;

use Storage;

class Contacts{

	/**
     * Array of user defined contacts
     *
     * @var array
     */
	protected $contacts;


	public function __construct(){
		$this->readFromFile();
	}

 	protected function readFromFile(){
 		$contacts = [];

		if(Storage::exists('contacts.json')){

			$contacts = json_decode(Storage::get('contacts.json'), true);

		}

		$this->contacts = $contacts;
		
 	}

 	public function save($array){

		Storage::put('contacts.json', json_encode($array));
 	}

	/**
     * Return array of user defined contacts
     *
     * @return array
     */
	public function all(){

		return $this->contacts;
	}

	/**
     * Return value of user contacts key
     * 
     * @param string $key
     * @return mixed
     */
	public function get($key){
		if(array_key_exists($key, $this->contacts)){
			return $this->contacts[$key];
		}
		return null;
	}

	/**
     * Return value of user contacts key
     * 
     * @param string $key
     * @return mixed
     */
	public function trans($key, $lang){

		if(array_key_exists($key, $this->contacts)){
			if(array_key_exists($lang, $this->contacts[$key]))
				return $this->contacts[$key][$lang];
		}
		else{
			return null;
		}
	}

}