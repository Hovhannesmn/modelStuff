<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\Profile;
use App\Service;

use Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index($profile_id)
    {
        if(intval(Session::get('step')) > 0 && intval(Session::get('step')) != 2)
        {
            return redirect()->to('profile');
        }
//    dd(Session::get('step'));
        $profile = Profile::findOrFail($profile_id);

        return view('profile.services.index')->with(['profile_id' => $profile_id, 'profile' => $profile]);
    }

    public function store(Request $request, $profile_id)
    {
        $profile = Profile::findOrFail($profile_id);

        $services = $request->input('service')?$request->input('service'):[];

        $profile->services()->sync(array_keys($services));

        if(intval(Session::get('step')) == 2)
        {
            Session::put('step', 3);
            return redirect()->to('profile/' . $profile_id . '/gallery');
        }

        return redirect()->to('/profile/' . $profile_id);
    }
}