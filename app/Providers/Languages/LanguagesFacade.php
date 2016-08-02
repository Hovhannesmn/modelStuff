<?php 

namespace App\Providers\Languages;

use Illuminate\Support\Facades\Facade;

class LanguagesFacade extends Facade{

	public static function getFacadeAccessor(){

		return 'LanguagesProvider';
		
	}

}