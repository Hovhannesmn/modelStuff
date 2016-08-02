<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Jobmarket;
use App\Role;
use App\Profile;
use Auth;

use Storage;

use Settings;
use Languages;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PrepareSettingsGeneralRequest;

class UsersController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();


        return view('admin.users.index')->with('users', $users);
    }

    public function show($role)
    {
    	$role = Role::where('name', $role)->first();

    	if($role){
    		return view('admin.users.index')->with('users', $role->users);
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

        return redirect()->to('/profile/'.$user->profile->id.'/edit');
    }

    public function edit($id)
    {
    	$user = User::findOrFail($id);
//        dd(Jobmarket::availableCondition());
    	return view('admin.users.edit')->with(['user' => $user, 'roles' => Role::allwithkeys()]);
    }

    public function create()
    {
    	return view('admin.users.create')->with('roles' , Role::allwithkeys());
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'role'	=> 'required|exists:roles,id',
            'password'	=> 'required|confirmed|between:5,20'
        ]);

    	$user = new User([
    		'name'	=> $request->input('name'),
    		'email'	=> $request->input('email'),
    		'password'	=> bcrypt($request->input('password')),
    	]);

    	$user->save();
    	
    	$user->roles()->attach($request->input('role'));
    	return redirect('admin/users');
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

    	return redirect('admin/users');
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
            		$object->roles()->detach();
                	$object->delete();
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
