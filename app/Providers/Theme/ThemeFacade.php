<?php 

namespace App\Providers\Theme;

use Illuminate\Support\Facades\Facade;

class ThemeFacade extends Facade{

	public static function getFacadeAccessor(){

		return 'ThemeProvider';
		
	}

}