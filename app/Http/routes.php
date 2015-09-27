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
    Route::post('/education/update','EducationController@update');
    Route::get('/education/delete','EducationController@delete');
    Route::post('/biography','BiographyController@update');
    Route::get('/article',['as'=>'articles', 'uses'=>'ArticleController@index']);
    Route::get('/article/create',['as'=>'article.create', 'uses'=>'ArticleController@create']);
    Route::get('/article/{article}/preview',['as'=>'article.preview', 'uses'=>'ArticleController@preview']);
    Route::get('/article/{article}/edit',['as'=>'article.edit', 'uses'=>'ArticleController@edit']);
    Route::put('/article/{article}/edit',['as'=>'article.update', 'uses'=>'ArticleController@update']);
    Route::delete('/article/{article}/delete',['as'=>'article.delete', 'uses'=>'ArticleController@delete']);
    Route::post('/article/{article}/banner', 'ArticleController@banner');
    Route::post('/article',['as'=>'article.add', 'uses'=>'ArticleController@add']);
    Route::post('/article/{article}/comment',['as'=>'article.comment.add', 'uses'=>'ArticleController@comment']);
    Route::post('/article/{article}/like',['as'=>'article.like.add', 'uses'=>'ArticleController@like']);

    Route::post('/location',['as'=>'location.store', 'uses'=>'LocationController@store']);

    Route::post('/post',['as'=>'post.add', 'uses'=>'PostController@add']);
    Route::post('/post/image','PostController@image');

    Route::get('/test','ProfileController@test');

    Route::group(['prefix' => 'skill', 'as'=>'skill.'], function () {
        Route::get('/','SkillController@index');
        Route::get('create',['as'=>'create', 'uses'=>'SkillController@create']);
        Route::get('{skill}/step1',['as'=>'edit.step1', 'uses'=>'SkillController@edit']);
        Route::post('create',['as'=>'add', 'uses'=>'SkillController@add']);
        Route::put('/{skill}/update',['as'=>'update', 'uses'=>'SkillController@update']);

        Route::get('/{skill}/step2',['as'=>'edit.step2', 'uses'=>'SkillController@skillTables']);
        Route::post('/{skill}/experience',['as'=>'add.experience', 'uses'=>'SkillController@addExperience']);
        Route::delete('experience','SkillController@deleteExperience');
        Route::post('experience/update','SkillController@updateExperience');
        Route::post('experience/preview','SkillController@previewExperience');
        Route::post('experience/like','SkillController@likeExperience');

        Route::post('/{skill}/degree',['as'=>'add.degree', 'uses'=>'SkillController@addDegree']);
        Route::delete('degree','SkillController@deleteDegree');
        Route::post('degree/update','SkillController@updateDegree');
        Route::post('degree/preview','SkillController@previewDegree');
        Route::post('degree/like','SkillController@likeDegree');

        Route::post('/{skill}/honor',['as'=>'add.honor', 'uses'=>'SkillController@addHonor']);
        Route::delete('honor','SkillController@deleteHonor');
        Route::post('honor/update','SkillController@updateHonor');
        Route::post('honor/preview','SkillController@previewHonor');
        Route::post('honor/like','SkillController@likeHonor');

        Route::post('/{skill}/history',['as'=>'add.history', 'uses'=>'SkillController@addHistory']);
        Route::delete('history','SkillController@deleteHistory');
        Route::post('history/update','SkillController@updateHistory');

        Route::get('/{skill}/step3',['as'=>'edit.step3', 'uses'=>'SkillController@ScheduleInfo']);

        Route::post('/{skill}/schedule',['as'=>'add.schedule', 'uses'=>'SkillController@addSchedule']);
        Route::delete('schedule','SkillController@deleteSchedule');
        Route::post('schedule/update','SkillController@updateSchedule');

        Route::post('/{skill}/paper',['as'=>'add.paper', 'uses'=>'SkillController@addPaper']);
        Route::delete('paper','SkillController@deletePaper');
        Route::post('paper/update','SkillController@updatePaper');

        Route::post('/{skill}/amount',['as'=>'add.amount', 'uses'=>'SkillController@addAmount']);
        Route::delete('amount','SkillController@deleteAmount');
        Route::post('amount/update','SkillController@updateAmount');

        Route::post('/{skill}/area',['as'=>'add.area', 'uses'=>'SkillController@addArea']);
        Route::delete('area','SkillController@deleteArea');
        Route::post('area/change','SkillController@updateArea');

        Route::post('/{skill}/gallery',['as'=>'add.gallery', 'uses'=>'SkillController@addGallery']);
        Route::delete('gallery','SkillController@deleteGallery');
        Route::post('gallery/update','SkillController@updateGallery');

        Route::post('{skill}/recommendation', ['as'=>'recommendation.store', 'uses'=>'RecommendationController@store']);

        Route::post('{skill}/endorse', ['as'=>'endorse.store', 'uses'=>'EndorseController@store']);
    });





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
        Route::get('diagram',['as'=>'diagram','uses'=>'Admin\VisitorController@show']);
        Route::get('/{method?}',['as'=>'list','uses'=>'Admin\VisitorController@index']);

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


        Route::get('/category',['as'=>'categories', 'uses'=>'Admin\CategoryController@index']);
        Route::post('/category',['as'=>'category.create', 'uses'=>'Admin\CategoryController@categoryCreate']);
        Route::put('/category/{category}',['as'=>'category.update', 'uses'=>'Admin\CategoryController@categoryUpdate']);
        Route::get('/category/{category}/edit',['as'=>'category.edit', 'uses'=>'Admin\CategoryController@categoryEdit']);
        Route::get('/category/{category}/delete',['as'=>'category.delete', 'uses'=>'Admin\CategoryController@categoryDelete']);
        Route::get('/sub_categories/{category}/{sub_category}/edit',['as'=>'sub_category.edit', 'uses'=>'Admin\CategoryController@subCategoryEdit']);
        Route::get('/sub_categories/{category}/{sub_category}/delete',['as'=>'sub_category.delete', 'uses'=>'Admin\CategoryController@subCategoryDelete']);
        Route::get('/sub_categories/{category}',['as'=>'sub_categories', 'uses'=>'Admin\CategoryController@subCategories']);
        Route::post('/sub_categories/{category}',['as'=>'sub_category.create', 'uses'=>'Admin\CategoryController@subCategoryCreate']);
        Route::put('/sub_categories/{category}/{sub_category}',['as'=>'sub_category.update', 'uses'=>'Admin\CategoryController@subCategoryUpdate']);


        Route::get('/university',['as'=>'universities', 'uses'=>'Admin\UniversityController@index']);
        Route::post('/university',['as'=>'university.create', 'uses'=>'Admin\UniversityController@create']);
        Route::get('/university/{university}/edit',['as'=>'university.edit', 'uses'=>'Admin\UniversityController@edit']);
        Route::put('/university/{university}',['as'=>'university.update', 'uses'=>'Admin\UniversityController@update']);
        Route::get('/university/{university}/delete',['as'=>'university.delete', 'uses'=>'Admin\UniversityController@delete']);


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

    Route::group(['prefix' => 'category', 'as'=>'category.'], function () {
        Route::get('sub',['as'=>'sub', 'uses'=>'Api\CategoryController@sub']);
        Route::get('tags',['as'=>'tags', 'uses'=>'Api\CategoryController@tags']);
    });

});


/**
 * Created by Emad Mirzaie on 12/09/2015.
 * FileS managment and upload
 */
Route::group(['prefix' => 'files', 'as'=>'files.'], function () {
    Route::post('uploader',['as'=>'uploader', 'uses'=>'FilesController@upload']);
    Route::post('attachment',['as'=>'attachment', 'uses'=>'FilesController@attachment']);
    Route::delete('attachment',['as'=>'attachment.delete', 'uses'=>'FilesController@deleteAttachment']);

    Route::post('article',['as'=>'article.attachment', 'uses'=>'FilesController@articleAttachment']);
    Route::post('article/uploader',['as'=>'article.uploader', 'uses'=>'FilesController@articleUpload']);
    Route::delete('article',['as'=>'article.attachment.delete', 'uses'=>'FilesController@deleteArticleAttachment']);
});