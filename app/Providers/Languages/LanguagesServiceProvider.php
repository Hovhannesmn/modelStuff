<?php

namespace App\Providers\Languages;


use Illuminate\Support\ServiceProvider;

class LanguagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application Languages service.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('LanguagesProvider', function(){
            return new Languages();
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
