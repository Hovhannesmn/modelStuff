<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'modelOwnOrAdmin' => \App\Http\Middleware\AccessModelOwnOrAdmin::class,
        'modelOnly' => \App\Http\Middleware\AccessOnlyModel::class,
        'ownerlOnly' => \App\Http\Middleware\AccessOnlyOwner::class,
        'adminOnly' => \App\Http\Middleware\AccessOnlyAdmin::class,
        'loginOnly' => \App\Http\Middleware\AccessOnlyLogin::class,
        'loginOrGuest' => \App\Http\Middleware\AccessLoginOrGuest::class,
        'blockedIp' => \App\Http\Middleware\RedirectIfIpBlocked::class

    ];
}
