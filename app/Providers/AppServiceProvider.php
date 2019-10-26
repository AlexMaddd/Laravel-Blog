<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // var_dump(\App\Post::archives());
        // // listens for @include(layouts.sidebar) to include archives() from Post
        view()->composer('layouts.sidebar', function($view){

            $view->with('archives', \App\Post::archives()); // \App makes it global

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
