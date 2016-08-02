<?php

namespace App\Providers\Navigation;


use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application settings service.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('NavigationProvider', function(){
            return new Navigation();			
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
