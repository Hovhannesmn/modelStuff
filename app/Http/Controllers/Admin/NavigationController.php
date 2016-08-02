<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Navigation;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    public function getIndex(){
        return view('admin.navigation.index');
    }

    public function postIndex(Request $request){

        Navigation::save($request->input('anchor'));

        return redirect()->action('Admin\NavigationController@getIndex');
    }
}
