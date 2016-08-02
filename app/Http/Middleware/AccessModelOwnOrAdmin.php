<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

class AccessModelOwnOrAdmin
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) 
        {
            $user = $this->auth->user();

            if($user->hasRole('admin'))
            {
                return $next($request);
            }

            if($user->hasRole('model'))
            {
                $profile = $user->profile;
                if($profile)
                {
                    if($profile->id == $request->route()->profile_id){
                        return $next($request);
                    }
                    return redirect()->to('profile');
                }
                return redirect()->to('profile/create');
            }
        }

        $request->session()->flash('redirectPath', $request->path());
        return redirect()->to('signin');
    }
}
