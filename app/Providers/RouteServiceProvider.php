<?php

namespace App\Providers;

use App\Announcement;
use App\Corporation;
use App\Coupon;
use App\CouponGallery;
use App\Event;
use App\Group;
use App\Offer;
use App\Problem;
use App\Recruitment;
use App\RecruitmentRequester;
use App\Report;
use App\Settle;
use App\Storage;
use App\User;
use Bican\Roles\Models\Role;
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
        $router->model('post' , 'App\Post');
        $router->model('category' , 'App\Category');
        $router->model('sub_category' , 'App\Category');
        $router->model('skill' , 'App\Skill');
        $router->model('profile' , 'App\User');
        $router->model('comment' , 'App\Comment');
        $router->model('poll' , 'App\Poll');
        $router->model('questionnaire' , 'App\Questionnaire');
        $router->model('coupon_user' , 'App\CouponUser');
        $router->model('showcase' , 'App\Showcase');
        $router->model('sticky' , 'App\Sticky');
        /**
         * Created By Dara on 22/10/2015
         */
//        $router->bind('offer',function($value){
//            return Offer::findOrFail($value);
//        });
        $router->bind('service',function($value){
           return CouponGallery::findOrFail($value);
        });
        $router->bind('coupon',function($value){
           return Coupon::findOrFail($value);
        });
        $router->bind('group',function($value){
            return Group::findOrFail($value);
        });
        $router->bind('problem',function($value){
            return Problem::findOrFail($value);
        });
        $router->model('offer' , 'App\Offer');
        $router->model('shop' , 'App\Shop');
        $router->model('product' , 'App\Product');
        $router->bind('event',function($value){
            return Event::findOrFail($value);
        });
        $router->bind('settle',function($value){
            return Settle::findOrFail($value);
        });

        $router->bind('report',function($value){
            return Report::findOrFail($value);
        });

        $router->bind('corporation',function($value){
            return Corporation::findOrFail($value);
        });

        /**
         * Created By Dara on 25/12/2015
         */
        $router->bind('announcement',function($value){
            return Announcement::findOrFail($value);
        });

        $router->bind('storage',function($value){
            return Storage::findOrFail($value);
        });

        $router->bind('role',function($value){
            return Role::findOrFail($value);
        });

        $router->bind('recruitment',function($value){
            return Recruitment::findOrFail($value);
        });

        $router->bind('recruitmentRequester',function($value){
            return RecruitmentRequester::findOrFail($value);
        });

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
