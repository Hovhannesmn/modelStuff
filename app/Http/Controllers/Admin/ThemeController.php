<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Theme;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function getIndex(){
        return view('admin.theme.index');
    }

    public function postIndex(Request $request){
        Theme::save($request->except('_token'));

        return redirect()->action('Admin\ThemeController@getIndex');
    }
}
