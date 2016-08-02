<?php
use App\User;

//
Route::get("/", 'SearchController@index');

Route::get('setup', 'SetupController@index');

Route::get("/", 'SearchController@index');
Route::get('/search',['uses' => 'SearchController@search','as' => 'search']);
Route::post('/find-model',['uses' => 'SearchController@findModel','as' => 'search']);



Route::group(['middleware' => 'guest'], function () {
    Route::get('profile-model/{profile_id}', 'Profile\ProfileController@show');


});

    Route::get('signin/{locate?}', 'Auth\AuthController@getLogins');
    Route::post('signin', 'Auth\AuthController@postLogins');
    Route::get('signout', 'Auth\AuthController@getLogout');
    Route::get('signup/{locate?}', 'Auth\AuthController@getRegisters');
    Route::post('signup', 'Auth\AuthController@postRegister');
    Route::get('password/email', 'Auth\AuthController@lostPassword');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmails');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware'=>'adminOnly'], function() {
    Route::get('/settings/general/save', 'SettingsController@saveGeneral');
    Route::controllers([ 'settings' => 'SettingsController']);

    Route::controllers([ 'contacts' => 'ContactsController']);

    Route::get('/media/upload', 'MediaController@upload');
    Route::resource('media', 'MediaController');
    Route::resource('sliders', 'SliderController');
    Route::resource('galleries', 'GalleryController');

    Route::resource('services', 'ServicesController');

    Route::controllers([ 'theme' => 'ThemeController']);

    Route::get('/pages/{page_id}/edit', 'PagesController@edit');
    Route::post('/pages/{page_id}/save', 'PagesController@save');
    Route::get('/pages/{page_id}/translate/{lang}', 'PagesController@translate');
    Route::post('/pages/{page_id}/translate/{lang}', 'PagesController@translateSave');
    Route::controllers([ 'pages' => 'PagesController']);

    Route::controllers(['navigation' => 'NavigationController']);

        Route::get('users/{user_id}/newprofile', 'UsersController@newProfile' );
    Route::resource('users', 'UsersController');

    Route::get('/', function(){ return view('admin.dashboard'); });

});

    Route::group(['prefix' => 'owner/profile', 'namespace' => 'Owner', 'middleware'=>['ownerlOnly']], function() {
        Route::get('/', 'ProfileController@index');

        Route::get('/jobmarket/create', 'JobmarketController@index');
        Route::post('/jobmarket/create', 'JobmarketController@create');

        Route::get('/done', 'ProfileController@done');
            Route::get('/create', 'ProfileController@create');
            Route::resource('{profile_id}/schedule', 'ScheduleController');
            Route::resource('users', 'UsersController');
            Route::get('/love-house', 'LovehouseController@index');
        Route::get('users/{user_id}/newprofile', 'UsersController@newProfile' );



            Route::resource('{profile_id}/gallery', 'GalleryController');
            Route::get('{profile_id}/services', 'ServicesController@index');
            Route::post('{profile_id}/services', 'ServicesController@store');
            Route::get("/home", 'SearchController@index');
            Route::get('{profile_id}', 'ProfileController@show');
            Route::get('{profile_id}/edit', 'ProfileController@edit');
            Route::post('{profile_id}/update', 'ProfileController@update');
            Route::post('{profile_id}', 'ProfileController@update');

        Route::get('{profile_id}/lovehouse', 'LovehouseController@show');
        Route::post('{profile_id}/lovehouse/update', 'LovehouseController@update');


    });


Route::group( ['prefix' => 'model/profile', 'namespace' => 'Model', 'middleware'=>['modelOnly'] ], function() {
    Route::get('/', 'ProfileController@index');
    Route::get('/done', 'ProfileController@done');
    Route::get('/create', 'ProfileController@create');


    Route::resource('{profile_id}/schedule', 'ScheduleController');

    Route::resource('{profile_id}/gallery', 'GalleryController');
    Route::get('{profile_id}/services', 'ServicesController@index');
    Route::post('{profile_id}/services', 'ServicesController@store');

    Route::get('{profile_id}/edit', 'ProfileController@edit');
    Route::post('{profile_id}/update', 'ProfileController@update');
    Route::get("/home", 'SearchController@index');

//    Route::get('{profile_id}/on', 'ProfileController@enable');
//    Route::get('{profile_id}/off', 'ProfileController@disable');

});

Route::group(['prefix' => 'profile/{profile_id}', 'namespace' => 'Profile'  ], function() {

    Route::resource('schedule', 'ScheduleController');

    Route::resource('gallery', 'GalleryController');
    Route::get('services', 'ServicesController@index');
    Route::post('services', 'ServicesController@store');

    Route::get('edit', 'ProfileController@edit');
    Route::post('update', 'ProfileController@update');

    Route::get('on', 'ProfileController@enable');
    Route::get('off', 'ProfileController@disable');
});

Route::group(['namespace' => 'Profile', 'middleware'=>'adminOnly'], function() {
    Route::get('profile/list', 'ProfileController@displaylist');
    Route::get('profile/{profile_id}', 'ProfileController@show');

});

Route::group(['middleware' =>  'loginOnly'  ], function () {
    Route::get("/home", 'SearchController@index');
    Route::post('add-favorite', 'Login\ProfileController@addFavorite');


});

Route::group(['middleware' =>  ['loginOrGuest' ] ], function () {
    Route::get("/home", 'SearchController@index');  
    Route::get('profile-model/{profile_id}', 'Login\ProfileController@show');


});


Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\AuthController@confirm'
]);

Route::group(['middleware'=>'blockedIp'], function() {
    Route::get('{p1}/{p2?}', 'FrontendController@page');
    Route::get('/block', 'FrontendController@home');
});