<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Create roles
        DB::table('roles')->insert([ 'name' => 'admin' ]);
        DB::table('roles')->insert([ 'name' => 'model' ]);
        DB::table('roles')->insert([ 'name' => 'owner' ]);
        DB::table('roles')->insert([ 'name' => 'login' ]);

        //Create services

        DB::table('services')->insert([ 'slug' => 'kissing', 'name' => json_encode(['de'=>'Kissing']) ]);
        DB::table('services')->insert([ 'slug' => 'french_kissing', 'name' => json_encode(['de'=>'French kissing']) ]);
        DB::table('services')->insert([ 'slug' => 'dirty_talk', 'name' => json_encode(['de'=>'Dirty talk']) ]);
        DB::table('services')->insert([ 'slug' => 'role_play', 'name' => json_encode(['de'=>'Role play']) ]);
        DB::table('services')->insert([ 'slug' => 'sex_toys', 'name' => json_encode(['de'=>'Sex toys']) ]);

        DB::table('services')->insert([ 'slug' => 'sex_classic', 'name' => json_encode(['de'=>'Sex classic']) ]);
        DB::table('services')->insert([ 'slug' => 'sex_anal', 'name' => json_encode(['de'=>'Sex anal']) ]);
        DB::table('services')->insert([ 'slug' => 'sex_lesbian', 'name' => json_encode(['de'=>'Sex lesbian']) ]);
        DB::table('services')->insert([ 'slug' => 'sex_group', 'name' => json_encode(['de'=>'Sex group']) ]);
        DB::table('services')->insert([ 'slug' => 'sex_couples', 'name' => json_encode(['de'=>'Couples']) ]);
        DB::table('services')->insert([ 'slug' => 'double_penetration', 'name' => json_encode(['de'=>'Double Penetration']) ]);

        DB::table('services')->insert([ 'slug' => 'handjob', 'name' => json_encode(['de'=>'Hand job']) ]);
        DB::table('services')->insert([ 'slug' => 'mutual_masturbation', 'name' => json_encode(['de'=>'Mutual masturbation']) ]);
        DB::table('services')->insert([ 'slug' => 'blowjob', 'name' => json_encode(['de'=>'Blow job']) ]);
        DB::table('services')->insert([ 'slug' => 'deep_throat', 'name' => json_encode(['de'=>'Deep throat']) ]);
        DB::table('services')->insert([ 'slug' => 'mutual_natural_oral', 'name' => json_encode(['de'=>'Mutual natural oral']) ]);
        DB::table('services')->insert([ 'slug' => 'cunnilingus', 'name' => json_encode(['de'=>'Cunnilingus for me']) ]);
        DB::table('services')->insert([ 'slug' => 'prostate_massage', 'name' => json_encode(['de'=>'Prostate massage']) ]);


        DB::table('services')->insert([ 'slug' => 'cum_on_body', 'name' => json_encode(['de'=>'Cum on body']) ]);
        DB::table('services')->insert([ 'slug' => 'cum_on_face', 'name' => json_encode(['de'=>'Facial - cum on face']) ]);
        DB::table('services')->insert([ 'slug' => 'cum_in_mouth', 'name' => json_encode(['de'=>'Cum in mouth']) ]);

        DB::table('services')->insert([ 'slug' => 'classic_massage', 'name' => json_encode(['de'=>'Classic massage']) ]);
        DB::table('services')->insert([ 'slug' => 'sensual_massage', 'name' => json_encode(['de'=>'Sensual massage']) ]);
        DB::table('services')->insert([ 'slug' => 'erotic_massage', 'name' => json_encode(['de'=>'Erotic massage']) ]);
        DB::table('services')->insert([ 'slug' => 'full_body_massage', 'name' => json_encode(['de'=>'Full Body Massage']) ]);

        $type = Settings::get('website_type');

        //Create users
        if($type == 'm')
        {
            $user = new App\User();

            $user->name = 'Nicci Paris';
            $user->email = 'nicciparis@gmail.com';
            $user->password = bcrypt('1423456');
            $user->remember_token = str_random(10);
            $user->save();

            $profile = factory('App\Profile')->make();
            $profile->name = $user->name;
            $profile->contact_email = $user->email;
            $profile->user_id = $user->id;
            $user->profile()->save($profile);
            
            $user->roles()->sync(array(1,2));
        }

        if($type == 'c')
        {
            $user = new App\User();

            $user->name = 'Website Admin';
            $user->email = 'admin@gmail.com';
            $user->password = bcrypt('123456');
            $user->remember_token = str_random(10);
            $user->save();
            
            $user->roles()->sync(array(1));

            $this->call(UserTableSeeder::class);
        }

        Model::reguard();
    }
}
