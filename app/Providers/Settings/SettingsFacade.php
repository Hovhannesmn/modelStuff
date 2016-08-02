<?php 

namespace App\Providers\Settings;

use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade{

	public static function getFacadeAccessor(){

		return 'SettingsProvider';
		
	}

}