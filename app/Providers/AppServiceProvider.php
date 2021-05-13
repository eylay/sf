<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // custom blade if statements
        Blade::if('admins', function () {
            return auth()->check() && (auth()->user()->is('admin') || auth()->user()->is('shop'));
        });
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->is('admin');
        });
        Blade::if('shop', function () {
            return auth()->check() && auth()->user()->is('shop');
        });
        Blade::if('user', function () {
            return auth()->check() && auth()->user()->is('user');
        });


        // set paginator to use bootstrap
        if (strpos(request()->path(), 'landing') === 0) {
           Paginator::useBootstrap();
        }
    }
}
