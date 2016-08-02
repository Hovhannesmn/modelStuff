<?php

namespace App\Providers\Settings;


use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application settings service.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('SettingsProvider', function(){
            return new Settings();			
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
