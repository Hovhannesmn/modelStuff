<?php 

namespace App\Providers\Navigation;

use Illuminate\Support\Facades\Facade;

class NavigationFacade extends Facade{

	public static function getFacadeAccessor(){

		return 'NavigationProvider';
		
	}

}