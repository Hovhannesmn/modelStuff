<?php

namespace App\Providers\Contacts;


use Illuminate\Support\ServiceProvider;

class ContactsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application settings service.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind('ContactsProvider', function(){
            return new Contacts();			
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
