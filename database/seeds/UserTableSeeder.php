<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 20)
        	->create()
        	->each(function($u){

        		$u->roles()->sync(array(2));

        		//Create user profile
        		$profile = factory(App\Profile::class)->make();
        		$profile->contact_email = $u->email;
        		$profile->name = $u->name;
        		$profile->confirmed = true;

        		$u->profile()->save($profile);

        		//Create profile image
        		$avatar = new App\ProfileImage();
        		$avatar->url = 'uploads/profiles/test/avatar/' . $profile->id . '.jpg';
        		$avatar->width = '768';
				$avatar->height = '1024';
				$avatar->is_general = true;

				$profile->images()->save($avatar);

				//Create profile gallery
				for($i = 1; $i <= 6; $i++)
				{
					$image = new App\ProfileImage();
	        		$image->url = 'uploads/profiles/test/gallery/' . $i . '.jpg';
	        		$image->order = $i;
	        		$image->width = '784';
					$image->height = '1176';
					$image->is_general = false;

					$profile->images()->save($image);
				}

				$servicesID = array();
				for($i = 1; $i <= 25; $i++)
				{
					if(rand(0, 100) > 40)
					{
						$servicesID[] = $i;
					}
				}
				$profile->services()->sync($servicesID);

        	});
    }
}
