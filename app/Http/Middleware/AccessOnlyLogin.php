<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

class AccessOnlyLogin
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

            if($this->auth->user()->hasRole('login'))
            {
                return $next($request);
            }
            return redirect()->to('home');
        }

        $request->session()->flash('redirectPath', $request->path());
        return redirect()->to('signin');
    }
}
