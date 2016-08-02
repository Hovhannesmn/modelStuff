<?php

namespace App\Providers\Theme;


use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application settings service.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('ThemeProvider', function(){
            return new Theme();			
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
