<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Lovehouse;
use Mail;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App;
use App\Page;
use Theme;
use Languages;
use Settings;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectPath = '/';

    protected $redirectAfterLogout = '/signin';

    protected $loginPath = '/signin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function postLogins(Request $request, User $userModel)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();
        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
//        $user = User::
//        $userModel->where('email',  $)
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if(!Auth::user()->confirmed){
                Auth::logout();
               Session::flash('message', 'Your account are not activated.');
                  return redirect()->to('signin');

            }
            $user = Auth::user();
            if($user->hasRole('admin'))
            {
                return redirect()->to('admin');
            }

            if($user->hasRole('model'))
            {

                return redirect()->to('model/profile');
            }
            if($user->hasRole('owner'))
            {

                return redirect()->to('owner/profile');
            }
            if($user->hasRole('login'))
            {
                return redirect()->to('/home');
            }
            return $this->handleUserWasAuthenticated($request, $throttles);
        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {

            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        if(isset($data['phonenumber'])){
//            dd("phone number");
            return Validator::make($data, [
                'name' =>       'required|max:255',
                'email' =>      'required|email|max:255|unique:users',
                'password' =>   'required|confirmed|min:6',
                'phonenumber' =>'required|max:14'
            ]);
        }else if(isset($data['love_house'])){
//            dd("love_ house");

            return Validator::make($data, [
                'name' =>       'required|max:255',
                'email' =>      'required|email|max:255|unique:users',
                'password' =>   'required|confirmed|min:6',
                'love_house' =>'required|max:14'
            ]);
        }else{
//            dd("normal user");
            return Validator::make($data, [
                'name' =>       'required|max:255',
                'email' =>      'required|email|max:255|unique:users',
                'password' =>   'required|confirmed|min:6',
            ]);


        }

    }

    public function lostPassword(){
        
        return view('auth\password');
    }

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;

        $user->save();

        Session::flash('message', 'You have successfully verified your account.');
        return redirect()->to('signin');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(isset($data['phonenumber']))  {

//            $user = User::create([
//                'name' => $data['name'],
//                'phonenumber' => $data['phonenumber'],
//                'email' => $data['email'],
//                'password' => bcrypt($data['password']),
//            ]);

            $confirmation_code = str_random(30);
//           $user =  \DB::table('users')->insert([
               $user = User::create([

                   'name' => $data['name'],
                'phonenumber' => $data['phonenumber'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
               'confirmation_code' => $confirmation_code
            ]);


            $user->roles()->sync([2]);

            Mail::send('emails.confirm', ['confirmation_code' => $confirmation_code], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), 'Your Application');

                $m->to($data['email'], $data['name'])->subject('Activation profile!');
            });
              Session::flash('message', 'Thanks for signing up! Please check your email.');
//            return redirect()->to('go');
            return ;

        }
        elseif (isset($data['love_house']))  {
            $confirmation_code = str_random(30);

            $user = User::create([

                'name' => $data['name'],
//                'lovehouse' => $data['love_house'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmation_code' => $confirmation_code

            ]);
            Lovehouse::create(
                [
                    'user_id' => $user->id,
                    'name' => $data['love_house'],

                ]
            );

            $user->roles()->sync([3]);


            Mail::send('emails.confirm', ['confirmation_code' => $confirmation_code], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), 'Your Application');

                $m->to($data['email'], $data['name'])->subject('Activation profile!');
            });
            Session::flash('message', 'Thanks for signing up! Please check your email.');


            return ;



        }
        else{
            $confirmation_code = str_random(30);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmation_code' => $confirmation_code

            ]);
            $user->roles()->sync([4]);

            Mail::send('emails.confirm', ['confirmation_code' => $confirmation_code], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), 'Your Application');

                $m->to($data['email'], $data['name'])->subject('Activation profile!');
            });
            Session::flash('message', 'Thanks for signing up! Please check your email.');
        return;


        }
    }


    public function getRegisters($locate=null)
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        if ($locate==null){
            App::setLocale(Languages::general());
        }else{
            App::setLocale($locate);

        }

        return view('auth.register', array('locate'=>$locate));
    }

    public function getLogins($locate=null)
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        if ($locate==null){
            App::setLocale(Languages::general());
        }else{
            App::setLocale($locate);

        }

        return view('auth.login', array('locate'=>$locate) );
    }



    protected function authenticated($request, $user){

        if($request->input('redirectPath')){
            return redirect()->to($request->input('redirectPath'));
        }
        
        if($user->hasRole('admin'))
        {
            return redirect()->to('admin'); 
        }

        if($user->hasRole('model'))
        {
            return redirect()->to('profile'); 
        }
        if($user->hasRole('owner'))
        {
            return redirect()->to('profile');
        }
        if($user->hasRole('login'))
        {
            return redirect()->to('home');
        }

        return redirect()->to($this->redirectPath);
    }

    public function postRegister(Request $request, Profile $profileModel)
    {
        $validator = $this->validator($request->all());
        $type = $request->input('user_type');
        if ($validator->fails()) {
            $request->session()->put('type_user', $type);

            $this->throwValidationException(
                $request, $validator
            );


        }


        $this->create($request->all());
        $request->session()->put('step', '1');

        return  Redirect::to('signin');

//        Auth::login($user);
//
//
//        return redirect()->to('profile/create');
    }
}
