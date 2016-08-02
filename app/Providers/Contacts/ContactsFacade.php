<?php 

namespace App\Providers\Contacts;

use Illuminate\Support\Facades\Facade;

class ContactsFacade extends Facade{

	public static function getFacadeAccessor(){

		return 'ContactsProvider';
		
	}

}