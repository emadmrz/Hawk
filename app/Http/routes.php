<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});

/**
 * Created by Emad Mirzaie on 02/09/2015.
 * Home Routes in this page user receive new feeds
 * also it's a group with home prefix
 */
Route::group(['prefix' => 'home', 'as'=>'home.'], function () {
    Route::get('/', ['middleware'=>['auth'], 'as'=>'home', 'uses'=>'HomeController@index']);
});



/**
 * Created by Emad Mirzaie on 02/09/2015.
 * profile of the simple and legal users with profile prefix
 */
Route::group(['prefix' => 'profile', 'as'=>'profile.', 'middleware'=>['auth','email'] ], function () {
    Route::get('/',['as'=>'me', 'uses'=>'ProfileController@index']);
    Route::post('/description','ProfileController@description');
    Route::delete('/deleteAvatar','CoverController@deleteAvatar');
    Route::delete('/deleteCover','CoverController@deleteCover');
    Route::post('/cover','CoverController@index');
    Route::post('/userinfo','InfoController@edit');
    Route::post('/education','EducationController@create');
    Route::get('/test','ProfileController@test');



    /**
     * Created by Emad Mirzaie on 02/09/2015.
     * Settings of user profiles and account
     */
    Route::group(['prefix' => 'setting', 'as'=>'setting.'], function () {
        Route::get('/password',['as'=>'password', 'uses'=>'SettingController@password']);
        Route::post('/password',['as'=>'changePassword', 'uses'=>'SettingController@changePassword']);

    });

});



/**
 * Created by Emad Mirzaie on 30/08/2015.
 * This Route is only for test reasons
 */
Route::get('/test', function (\Illuminate\Http\Request $request) {
    if ($request->input('email') == 'emad'){
        return Response('Hello world!', 200);
    }
    else {
        return Response(' no no Hello world!', 404);
    }
});


/**
 * Created by Emad Mirzaie on 03/09/2015.
 * Email Confirmation it should be before Auth route
 */

Route::get('auth/email',['middleware'=>'auth', 'uses'=>'Auth\EmailController@index']);
Route::post('auth/email',['middleware'=>'auth', 'uses'=>'Auth\EmailController@resend']);
Route::get('auth/email/{confirmation_code}','Auth\EmailController@check');


/**
 * Created by Emad Mirzaie on 30/08/2015.
 * Login and register routes
 */
Route::controllers([
    'auth'=>'Auth\AuthController' ,
    'password'=>'Auth\PasswordController'
]);

/**
 * Created by Emad Mirzaie on 31/08/2015.
 * Admin panel route group with admin prefix
 */
Route::group(['prefix' => 'admin', 'as'=>'admin.'], function () {
    /*
     * Create By Dara on 11/9/2015
     * visitor route group
     */
    Route::group(['prefix'=>'visitors','as'=>'visitors.'],function(){
       Route::get('/',['as'=>'list','uses'=>'Admin\VisitorController@index']);
    });


    /**
     * Created by Dara on 5/9/2015
     * Admin register route group
     */
    Route::group(['prefix'=>'admins','as'=>'admins.'],function(){
        Route::get('/',['as'=>'list','uses'=>'Admin\AdminController@index']);
        Route::get('create',['as'=>'create','uses'=>'Admin\AdminController@create']);
        Route::post('create','Admin\AdminController@store');
        Route::get('/{admin}/delete',['as'=>'delete','uses'=>'Admin\AdminController@delete']);
        Route::get('/{admin}/edit',['as'=>'edit','uses'=>'Admin\AdminController@edit']);
        Route::put('/{admin}',['as'=>'update','uses'=>'Admin\AdminController@update']);
    });

    Route::get('/','Admin\DashboardController@index');
    Route::get('test','Admin\DashboardController@test');

    /**
     * Created by Emad Mirzaie on 31/08/2015.
     * Administration of users with users prefix
     */
    Route::group(['prefix' => 'users', 'as'=>'users.'], function () {
        Route::get('/',['as'=>'list', 'uses'=>'Admin\UserController@index']);
        Route::put('/{user}',['as'=>'update', 'uses'=>'Admin\UserController@update']);
        Route::get('/{user}/delete',['as'=>'delete', 'uses'=>'Admin\UserController@delete']);
        Route::get('/{user}/edit',['as'=>'edit', 'uses'=>'Admin\UserController@edit']);
    });

    Route::group(['prefix' => 'setting', 'as'=>'setting.'], function () {

        /**
         * Created by Emad Mirzaie on 10/09/2015.
         * admin setting of provinces and cities
         */
        Route::get('/province',['as'=>'provinces', 'uses'=>'Admin\ProvinceController@index']);
        Route::post('/province',['as'=>'province.create', 'uses'=>'Admin\ProvinceController@provinceCreate']);
        Route::put('/province/{province}',['as'=>'province.update', 'uses'=>'Admin\ProvinceController@provinceUpdate']);
        Route::get('/province/{province}/edit',['as'=>'province.edit', 'uses'=>'Admin\ProvinceController@provinceEdit']);
        Route::get('/province/{province}/delete',['as'=>'province.delete', 'uses'=>'Admin\ProvinceController@provinceDelete']);
        Route::get('/cities/{province}/{city}/edit',['as'=>'city.edit', 'uses'=>'Admin\ProvinceController@cityEdit']);
        Route::get('/cities/{province}/{city}/delete',['as'=>'city.delete', 'uses'=>'Admin\ProvinceController@cityDelete']);
        Route::get('/cities/{province}',['as'=>'cities', 'uses'=>'Admin\ProvinceController@cities']);
        Route::post('/cities/{province}',['as'=>'city.create', 'uses'=>'Admin\ProvinceController@cityCreate']);
        Route::put('/cities/{province}/{city}',['as'=>'city.update', 'uses'=>'Admin\ProvinceController@cityUpdate']);

    });

});


/**
 * Created by Emad Mirzaie on 10/09/2015.
 * Web Api
 */
Route::group(['prefix' => 'api', 'as'=>'api.'], function () {

    Route::group(['prefix' => 'location', 'as'=>'location.'], function () {
        Route::get('cities',['as'=>'cities', 'uses'=>'Api\LocationController@cities']);
    });

});