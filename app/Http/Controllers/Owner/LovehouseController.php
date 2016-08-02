<?php

namespace App\Http\Controllers\Owner;

use App\User;
use Illuminate\Http\Request;

use Auth;
use Session;

use App\Profile;
use App\Lovehouse;
use App\Service;

use Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LovehouseController extends Controller
{
    public function index()
    {
        $profile = Auth::user()->profile;
        if($profile){

            $profile_image = $profile->image;

            $models = User::where('lovehouse_id', Auth::user()->lovehouse->id)->get();

            return view('owner.love_house.index')->with([ 'profile_image' => $profile_image , 'profile' => $profile, 'models' =>$models]);
        }

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

    public function show($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);

        return view('owner.love_house.edit')->with(['profile' => $profile, 'profile_image'=>$profile->image]);
    }

    public function update(Request $request, $profile_id)
    {
        $this->validate($request, [
            'lovehosue_name'              => 'required',
            'about_full'        => 'array|translated',
            'contact_email'     => 'required|email',
            'cellphone'         => 'required',
//            'lovehouse_location'       => 'required',

        ]);




        $lovehouse = Lovehouse::findOrFail(Auth::user()->lovehouse->id);
//        $lovehouse->description  = $request->input('about_full');
        $lovehouse->cellphone         = $request->input('cellphone');
        $lovehouse->contact_email     = $request->input('contact_email');
        $lovehouse->name = $request->input('lovehosue_name');
        $lovehouse->location = $request->input('lovehouse_location');
        $lovehouse->save();
        dd($lovehouse);

        if(intval(Session::get('step')) == 3)
        {
            Session::put('step', 4);
            return redirect()->to('owner/profile/' . $profile_id . '/gallery');
        }

        return redirect('owner/profile/'.$profile_id.'/lovehouse');
    }


}