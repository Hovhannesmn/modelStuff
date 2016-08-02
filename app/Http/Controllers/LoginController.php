<?php

namespace App\Http\Controllers\Login;

use App\Favorite;
use Auth;

use App\User;
use App\Profile;

use Session;
use Request as GlobalRequest;

use Settings;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function index()
    {
        //Only user with role [model] can be here



        //Only model with completed steps can be here
        $profile = Auth::user()->profile;
        if($profile){
            $profile_image = $profile->image;



            return view('profile.index')->with(['profile' => $profile,  'profile_image' => $profile_image ]);
        }



        return redirect()->to(Auth::user()->roles[0]->name . '/profile/create');
    }

    public function addFavorite(Request $request){
         $model_id =  $request->input('id');

        $model =  User::findOrFail($model_id);
        if(!empty($model) && $model->roles[0]->name=='model' ){
            Favorite::create([
                'login_id' => Auth::user()->id,
                'model_id' => $model_id,
            ]);
        }
    }


    public function done()
    {
        if(intval(Session::get('step')) == 4){
            Session::forget('step');
        }
            return redirect()->to(Auth::user()->roles[0]->name . '/profile');
    }



    public function show($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $addfavorite = false;

        foreach(Auth::user()->favorite as $favorite){
            if($favorite->model_id == $profile->user_id){
                $addfavorite = "true";
            }
        }

        return view('profile.index')->with(['profile' => $profile, "addfavorite" => $addfavorite, 'profile_image'=>$profile->image]);
    }

    public function edit($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);

        $profile->availableLanguages();

        if($profile){
            $profile_image = $profile->image;
            return view('profile.edit')->with(['profile' => $profile, 'profile_image' => $profile_image ]);
        }
        return redirect()->to('profile');
    }

    public function enable($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $profile->confirmed = true;
        $profile->save();
        return redirect()->to('profile/list');
    }

    public function disable($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $profile->confirmed = false;
        $profile->save();
        return redirect()->to(Auth::user()->roles[0]->name . '/profile/list');
    }

    public function update(Request $request, $profile_id)
    {
        $this->validate($request, [
            'name'              => 'required',
            'about_short'       => 'array|translated',
            'about_full'        => 'array|translated',
            'contact_email'     => 'required|email',
            'cellphone'         => 'required',
            'nationality'       => 'required',
            'languages'         => 'array',
            'haircolor'         => 'required',
            'age'               => 'required|integer',
            'weight'            => 'required|integer',
            'height'            => 'required|integer',
            'breast_letter'     => 'required',
            'breast_number'     => 'required|integer',
            'intimicy'          => 'required'
        ]);

        $profile = Profile::findOrFail($profile_id);

        $profile->name              = $request->input('name');
        $profile->about_short       = $request->input('about_short');
        $profile->about_full        = $request->input('about_full');
        $profile->contact_email     = $request->input('contact_email');
        $profile->cellphone         = $request->input('cellphone');
        $profile->nationality       = $request->input('nationality');
        $profile->languages         = $request->input('languages');
        $profile->haircolor         = $request->input('haircolor');
        $profile->age               = $request->input('age');
        $profile->weight            = $request->input('weight');
        $profile->height            = $request->input('height');
        $profile->breast_number     = $request->input('breast_number');
        $profile->breast_letter     = $request->input('breast_letter');
        $profile->intimicy          = $request->input('intimicy');
        $profile->smoke             = $request->input('smoke')?1:0;
        $profile->drink             = $request->input('drink')?1:0;


        $profile->save();

        if(Auth::user()->profile){
            if(Auth::user()->profile->id != $profile_id){
                return redirect()->to(Auth::user()->roles[0]->name . '/profile/'.$profile_id);
            }
        }else{
            return redirect()->to(Auth::user()->roles[0]->name . '/profile/'.$profile_id);
        }

        if(intval(Session::get('step')) == 1){
            Session::put('step', 2);
            return redirect()->to(Auth::user()->roles[0]->name . '/profile/' . $profile->id . '/services');
        }

        return redirect()->to(Auth::user()->roles[0]->name . '/profile');
    }
}