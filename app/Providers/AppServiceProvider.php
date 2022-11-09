<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;

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
        Paginator::useBootstrap();

        view()->composer('layouts.master', function ($view) {

            $theme = Cookie::get('theme');
        
            if ($theme != 'dark-theme' && $theme != 'light') {
        
                $theme = 'light';
        
            }
        
            $view->with('theme', $theme);
        
        });
    }
}
