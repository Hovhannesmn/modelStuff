<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use DB;

use Settings;

class RedirectIfIpBlocked
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
        if(!Settings::hasBlockAccess())
        {
            return $next($request);
        }

        if(!$this->checkSession($request))
        {
            $this->revalidateSession($request);
        }

        $ipInfo = $request->session()->get('ip_info');

        //dd($ipInfo);

        if($ipInfo['state'] == 0)
            abort(404);

        return $next($request);
    }

    protected function checkSession($request)
    {
        if(!$request->session()->has('ip_info'))
        {
            return false;
        }

        $ipInfo = $request->session()->get('ip_info');

        return ( 
            $ipInfo['state'] == 1 && 
            $ipInfo['ip'] == $_SERVER['REMOTE_ADDR'] && 
            $ipInfo['updatedAt'] > Carbon::now()//->subMinutes(5)
        );
    }

    protected function revalidateSession($request)
    {
        $blockedByIp = $this->checkIp($_SERVER['REMOTE_ADDR']);
        $blockedByCountry = $this->checkCountry($_SERVER['REMOTE_ADDR']);

        $ipInfo = [
            'state' => (int)(!$blockedByIp && !$blockedByCountry),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'updatedAt' => Carbon::now()
        ];

        $request->session()->set('ip_info', $ipInfo);
    }

    protected function checkCountry($ip)
    {
        $geoData = DB::connection('mysql_geoip')->select("SELECT * FROM countryByIp WHERE INET_ATON('".$ip."') >= ip_start_index AND INET_ATON('".$ip."') <= ip_end_index");
        
        if(count($geoData) > 0)
        {
            return Settings::blockedByCountry(strtolower($geoData[0]->country_code));
        }

        return true; 
    }

    protected function checkIp($ip)
    {
        return Settings::blockedByIp($ip);
    }
}
