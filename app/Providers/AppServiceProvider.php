<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Created By Dara on 7/11/2015
         * settlement side view compose
         */
        view()->composer('partials.settleManagement',function($view){
            $view->with('amount',Auth::user()->credits()->sum('amount'));
        });
        view()->composer('partials.settleManagement','App\Http\Controllers\EventController');

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
