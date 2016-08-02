<?php

namespace App\Http\Controllers\Owner;

use App\User;
use App\Role;
use App\Profile;
use Auth;

use phpDocumentor\Reflection\Types\Object_;
use Storage;

use Settings;
use Languages;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PrepareSettingsGeneralRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

            $users = User::where('lovehouse_id', Auth::user()->lovehouse->id)->get();



        return view('owner.users.index')->with('users', $users);
    }

    function __construct()
    {
    }

    public function show($role)
    {
    	$role = Role::where('name', $role)->first();

    	if($role){
    		return view('owner.users.index')->with('users', $role->users);
    	}

    	return abort(404);
    }

    public function newProfile($user_id)
    {
        $user = User::findOrFail($user_id);
        if(!$user->profile)
        {
            $user->profile()->save(new Profile(['name'=>$user->name, 'confirmed' => true]));
            $user->load('profile');
        }

        return redirect()->to('/owner/profile/'.$user->profile->id.'/edit');
    }

    public function edit($id)
    {
    	$user = User::findOrFail($id);

    	return view('owner.users.edit')->with(['user' => $user, 'roles' => Role::allwithkeys()]);
    }

    public function create()
    {
//        dd(Role::allwithkeys());

    	return view('owner.users.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password'	=> 'required|confirmed|between:5,20'
        ]);

    	$user = new User([
    		'name'	=> $request->input('name'),
    		'email'	=> $request->input('email'),
    		'password'	=> bcrypt($request->input('password')),
            'lovehouse_id' => Auth::user()->lovehouse->id,
            "confirmed"    => 1
    	]);

    	$user->save();
    	
    	$user->roles()->attach(2);

    	return redirect('owner/profile/users');
    }

    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user_id.'|email',
            'role'  => 'required|exists:roles,id',
            'password'  => 'confirmed|between:5,20'
        ]);

    	$user = User::findOrFail($user_id);

    	$user->name = $request->input('name');
    	$user->email = $request->input('email');

    	if($request->input('password')){
    		$user->password = bcrypt($request->input('password'));
    	}

    	$user->roles()->sync($request->input('role'));

    	$user->save();

    	return redirect('owner/users');
    }

    public function destroy($id) 
    {
    	$user = Auth::user();
        $list = explode('-', $id);
        $deleted = [];

        foreach ($list as $item) {
            $object = User::find($item);
            if($object){
            	if($object->id != $user->id){
                    $object->lovehouse_id = 0;
                    $object->save();
                	$deleted[] = $object->id;
            	}
            	else{
            		$deleted['error'] = 'You can\'t remove yourself';
            	}
            }
        }

        return $deleted;
    }
}
