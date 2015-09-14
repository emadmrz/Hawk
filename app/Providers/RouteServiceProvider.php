<?php

namespace App\Providers;

use App\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

//        $router->model('user' , 'App\User');

        $router->bind('user' , function($value){
            return User::with('roles')->findOrFail($value);
        });


        /**
         * created by dara on 6/9/2015
         * add binding for admin wild card
         */
        $router->bind('admin' , function($value){
            return User::with('roles')->findOrFail($value);
        });

        /**
         * Created by Emad Mirzaie on 09/09/2015.
         * province wild cart
         */
        $router->model('province' , 'App\Province');
        $router->model('city' , 'App\Province');
        $router->model('university' , 'App\University');
        $router->model('article' , 'App\Article');


    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
