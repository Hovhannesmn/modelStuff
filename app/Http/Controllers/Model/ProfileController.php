<?php

namespace App\Http\Controllers\Model;

use Auth;

use App\User;
use App\Profile;

use Session;
use Request as GlobalRequest;

use Settings;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index()
    {
        //Only user with role [model] can be here
        $response = $this->checkSteps();
        if($response){
            return $response;
        }


        //Only model with completed steps can be here
        $profile = Auth::user()->profile;
        if($profile){

            $profile_image = $profile->image;

            return view('profile.index')->with(['profile' => $profile, 'profile_image' => $profile_image ]);
        }

        return redirect()->to('model/profile/create');
    }

    public function checkSteps(){
        $register_step = intval(Session::get('step'));

        if($register_step > 0){
            if($register_step == 1){
                if(GlobalRequest::is('model/profile/create')){
                    return null;
                }else{
                    return redirect('model/profile/create');
                }
            }
            $profile = Auth::user()->profile;
            if(!$profile){
                Session::put('step', 1);
                return redirect('model/profile/create');
            }
            if($register_step == 2){
                return redirect('model/profile/'.$profile->id.'/services');
            }
            if($register_step == 3){
                return redirect('model/profile/'.$profile->id.'/schedule');
            }
            if($register_step == 4){
                return redirect('model/profile/'.$profile->id.'/gallery');
            }
        }

        return null;
    }

    public function done()
    {
        if(intval(Session::get('step')) == 4){
            Session::forget('step');
        }
        return redirect()->to('model/profile');
    }



    public function create(Request $request)
    {

        //Only user with role [model] can be here
        $response = $this->checkSteps();
        if($response){
            return $response;
        }

        //Only model with running first step can be here 
        $profile = Auth::user()->profile;
        if(!$profile)
        {
            $profile = new Profile();
            $profile->name = Auth::user()->name;
            Auth::user()->profile()->save($profile);
        }
        
        return view('profile.edit')->with(['profile' => $profile, 'profile_image' => $profile->image]);
    }



    public function displaylist()
    {
        return view('profile.list')->with(['profiles'=>Profile::all()]);
    }


    public function show($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);

        return view('profile.index')->with(['profile' => $profile, 'profile_image'=>$profile->image]);
    }

    public function edit($profile_id)
    {
        if($profile_id != Auth::user()->profile->id ){
//            return  $this->edit(Auth::user()->profile->id );
            return redirect()->to('model/profile');

        }
        $profile = Profile::findOrFail($profile_id);


        $profile->availableLanguages();
        
        if($profile){
            $profile_image = $profile->image;
            return view('profile.edit')->with(['profile' => $profile, 'profile_image' => $profile_image ]);
        }
        return redirect()->to('model/profile');
    }

    public function enable($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $profile->confirmed = true;
        $profile->save();
        return redirect()->to('model/profile/list');
    }

    public function disable($profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $profile->confirmed = false;
        $profile->save();
        return redirect()->to('model/profile/list');
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
                return redirect()->to('model/profile/'.$profile_id);
            }
        }else{
            return redirect()->to('model/profile/'.$profile_id);
        }

        if(intval(Session::get('step')) == 1){
            Session::put('step', 2);
            return redirect()->to('model/profile/' . $profile->id . '/services');
        }

        return redirect()->to('model/profile');
    }

    public function __constructor()
    {

    }
}