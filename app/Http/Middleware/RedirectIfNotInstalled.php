<?php

namespace App\Http\Middleware;

use Closure;

use Request;

use DB;
use PDOException;

class RedirectIfNotInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            DB::connection()->getDatabaseName();
        }
        catch(PDOException $exception){
            if(!Request::is('setup'))
               return redirect()->to('setup');
        }


        /**
         * Remove installation middleware from Kernel definition   
         */
        if(file_exists(app_path('Http/Kernel.php'))){
            $content = file_get_contents(app_path('Http/Kernel.php'));

            $search = '\App\Http\Middleware\RedirectIfNotInstalled::class,';

            $content = str_replace($search, '', $content);
            
            file_put_contents(app_path('Http/Kernel.php'), $content);
        }   


        // if(true){
        //     if(!Request::is('setup*'))
        //         return redirect()->to('setup');
        // }

        return $next($request);
    }
}
