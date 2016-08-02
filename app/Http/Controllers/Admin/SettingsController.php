<?php

namespace App\Http\Controllers\Admin;

use Storage;

use Settings;
use Languages;

use Theme;

use DB;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PrepareSettingsGeneralRequest;

class SettingsController extends Controller
{
    public function getIndex(){
    	return redirect()->action('Admin\SettingsController@getGeneral');
    }

    public function getGeneral(){
    	return view('admin.settings.general');
    }

    public function postGeneral(Request $request){
        $this->validate($request, [
            'website_url' => 'required|url',
            'system_email' => 'required|email',
        ]);

        Settings::saveSettings($request->all());

        return redirect()->action('Admin\SettingsController@getGeneral');
    }

    public function getLanguages(){

        return view('admin.settings.languages');
    }

    public function postLanguages(Request $request){

        $input = $request->all();

        if(array_key_exists('list', $input)){
            $input = $input['list'];
        }else{
            $input = [];
        }

        return Languages::saveLanguages($input);
    }

    public function getStrings(){

        return view('admin.settings.strings');
    }

    public function postStrings(Request $request){
       
        Languages::saveStrings($request->all());

        return redirect()->action('Admin\SettingsController@getStrings');
    }

    public function getThemes(){
        return view('admin.settings.themes');
    }

    public function postThemes(Request $request){
        if($request->input('themename') != '')
        {
            Settings::set('active_theme', $request->input('themename'));
        }

        return redirect()->action('Admin\SettingsController@getThemes');
    }

    public function getAccess()
    {
        $dbCountries = DB::connection('mysql_geoip')->select("SELECT COUNTRY_ALPHA2_CODE AS code, COUNTRY_NAME as name FROM countries");
        
        $countries = [];

        foreach ($dbCountries as $country) {
            $countries[$country->code] = $country->name;
        }

        return view('admin.settings.access')->with('countries', $countries);
    }

    public function postAccess(Request $request)
    {
        $blocked = [
            'country' => $request->input('country'),
            'ip' => explode(PHP_EOL, $request->input('ip')),
            'hasBlock' => $request->has('need_block')?1:0
        ];

        Settings::saveAccessConfiguration($blocked);

        return redirect()->action('Admin\SettingsController@getAccess');
    }
}
