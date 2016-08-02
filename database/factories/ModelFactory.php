<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstNameFemale . ' ' . $faker->lastName,
        'email' => $faker->freeEmail,
        'password' => bcrypt('dmkmm0002'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    $about_short = [];
    $about_full = [];
    foreach (Languages::all() as $key => $value) {
         $about_short[$value] = $faker->sentence();
         $about_full[$value] = $faker->paragraph();
    }
    return [
        'about_short' => $about_short,
        'about_full'  => $about_full,

        'contact_email' => '',
        'cellphone'    => $faker->phoneNumber(),

        'nationality'   => 'German',

        'languages' => array('English','Deutsch'),

        'age'   => $faker->numberBetween(18, 38),
        'height'   => $faker->numberBetween(155, 195),
        'weight' => $faker->numberBetween(40, 90),
        'haircolor' => $faker->randomElement(['light_blonde', 'black', 'brown', 'dark_brown']),
        'breast_number' => $faker->randomElement(['60', '65', '70', '75', '80']),
        'breast_letter' => $faker->randomElement(['A', 'B', 'C', 'D']),
        
        'intimicy' => $faker->randomElement(['clean', 'half_shaved', 'some_hair', 'hairy']),
        
        'smoke' => $faker->numberBetween(0, 1),
        'drink' => $faker->numberBetween(0, 1),

        'confirmed' => 1,
    ];
});
