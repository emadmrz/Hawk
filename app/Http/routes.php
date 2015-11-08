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


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','IndexController@index');
Route::get('/coupon', function(){
    return view('store.offer.coupon');
});

/**
 * Created by Emad Mirzaie on 02/09/2015.
 * Home Routes in this page user receive new feeds
 * also it's a group with home prefix
 */
Route::group(['prefix' => 'home', 'as'=>'home.'], function () {
    Route::get('', ['middleware'=>['auth'], 'as'=>'home', 'uses'=>'HomeController@index']);
    Route::get('/profile/{profile}', ['as'=>'profile', 'uses'=>'HomeController@profile']);
    Route::get('/profile/{profile}/article', ['as'=>'articles', 'uses'=>'ArticleController@otherList']);
    Route::get('/profile/{profile}/article/{article}/preview', ['as'=>'article.preview', 'uses'=>'ArticleController@otherPreview']);
    Route::get('/profile/{profile}/post/{post}/preview',['as'=>'post.preview', 'uses'=>'PostController@otherPreview']);
    Route::post('/friend/request', ['as'=>'friend.request', 'uses'=>'FriendController@request']);
    Route::post('/profile/related','ProfileController@related');
    Route::post('/stream/notification','StreamController@notification');

    Route::get('/profile/{profile}/poll/{poll}/preview',['as'=>'poll.preview', 'uses'=>'PollController@preview']);
    Route::post('/poll/{poll}/preview',['as'=>'poll.vote', 'uses'=>'PollController@vote']);

    /**
     * Created By Dara on 27/10/2015
     * offer handling
     */
    Route::get('/profile/{profile}/offer/{offer}/coupon/{coupon}/buy',['as'=>'profile.offer.coupon.buy','uses'=>'CouponController@buy']);
    Route::any('/profile/offer/coupon/buy/callback',['as'=>'profile.offer.coupon.callback','uses'=>'CouponController@callback']);

    Route::get('/profile/{profile}/questionnaire/{questionnaire}/preview',['as'=>'questionnaire.preview', 'uses'=>'QuestionnaireController@preview']);
    Route::post('/questionnaire/{questionnaire}/tick',['as'=>'questionnaire.tick', 'uses'=>'questionnaireController@tick']);
    Route::get('/profile/{profile}/questionnaire/{questionnaire}/result',['as'=>'questionnaire.result', 'uses'=>'questionnaireController@result']);

    Route::group(['prefix' => 'shop', 'as'=>'shop.'], function () {
        Route::get('{shop}',['as'=>'index', 'uses'=>'ShopController@home']);
        Route::get('{shop}/aboutus',['as'=>'aboutus', 'uses'=>'ShopController@aboutUsPage']);
        Route::get('{shop}/contactus',['as'=>'contactus', 'uses'=>'ShopController@contactUsPage']);
        Route::get('{shop}/products',['as'=>'products', 'uses'=>'ShopController@showroom']);
        Route::get('{shop}/product/{product}',['as'=>'product', 'uses'=>'ShopController@product']);
        Route::post('{shop}/product/{product}/comment',['as'=>'product.comment', 'uses'=>'CommentController@product']);
        Route::post('product/price','ProductController@calculatePrice');
    });

});

/**
 * Created By Dara on 31/10/2015
 * handling the group actions such post comment problem ..
 */
Route::group(['prefix' => 'group', 'as' => 'group.'], function () {
    Route::get('/{group}',['as'=>'index','uses'=>'GroupController@index']);
    Route::post('/{group}/join',['as'=>'join','uses'=>'GroupController@join']);
    Route::post('/{group}/leave',['as'=>'leave','uses'=>'GroupController@leave']);
    Route::post('/{group}/post/add',['as'=>'post.add','uses'=>'PostController@addGroupPost']);
    Route::get('/{group}/post/{post}',['as'=>'post.preview','uses'=>'PostController@postGroupPreview']);
    Route::get('/{group}/problem/create',['as'=>'problem.create','uses'=>'ProblemController@create']);
    Route::get('/{group}/problem/{problem}',['as'=>'problemPreview','uses'=>'ProblemController@problemPreview']);
    Route::post('/{group}/problem/add',['as'=>'problem.add','uses'=>'ProblemController@add']);
    Route::post('post/{post}/comment',['as'=>'post.comment.add','uses'=>'CommentController@postGroup']);
    Route::post('problem/{problem}/comment', ['as' => 'problem.comment.add', 'uses' => 'CommentController@problem']);
    Route::post('/problem/{problem}/comment/{comment}/delete', ['as' => 'problem.comment.delete', 'uses' => 'CommentController@problemDelete']);
    Route::post('/problem/{problem}/comment/{comment}/update', ['as' => 'problem.comment.update', 'uses' => 'CommentController@problemUpdate']);
    Route::post('/problem/{problem}/comment/{comment}/confirm',['as'=>'problem.answer','uses'=>'ProblemController@confirmAnswer']);
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
    Route::post('/biography/preview','BiographyController@preview');
    Route::get('/article',['as'=>'articles', 'uses'=>'ArticleController@index']);
    Route::get('/article/create',['as'=>'article.create', 'uses'=>'ArticleController@create']);
    Route::get('/article/{article}/preview',['as'=>'article.preview', 'uses'=>'ArticleController@preview']);
    Route::get('/article/{article}/edit',['as'=>'article.edit', 'uses'=>'ArticleController@edit']);
    Route::put('/article/{article}/edit',['as'=>'article.update', 'uses'=>'ArticleController@update']);
    Route::delete('/article/{article}/delete',['as'=>'article.delete', 'uses'=>'ArticleController@delete']);
    Route::post('/article/{article}/banner', ['middleware' => 'storage', 'uses'=>'ArticleController@banner']);
    Route::post('/article',['as'=>'article.add', 'uses'=>'ArticleController@add']);
    Route::post('/article/{article}/comment',['as'=>'article.comment.add', 'uses'=>'CommentController@article']);
    Route::post('/article/{article}/like',['as'=>'article.like.add', 'uses'=>'ArticleController@like']);

    Route::get('/coupon/{coupon_user}/preview',['as'=>'coupon.preview','uses'=>'CouponController@preview']);


    Route::post('/location',['as'=>'location.store', 'uses'=>'LocationController@store']);

    Route::post('/post',['as'=>'post.add', 'uses'=>'PostController@add']);
    Route::post('/post/image','PostController@image');
    Route::get('/post',['as'=>'post.list', 'uses'=>'PostController@index']);
    Route::get('/post/{post}/preview',['as'=>'post.preview', 'uses'=>'PostController@preview']);
    Route::delete('/post/{post}/delete',['as'=>'post.delete', 'uses'=>'PostController@delete']);
    Route::post('/post/{post}/comment',['as'=>'post.comment.add', 'uses'=>'CommentController@post']);
    Route::post('/post/{post}/comment/{comment}/delete',['as'=>'post.comment.delete', 'uses'=>'CommentController@postDelete']);
    Route::post('/post/{post}/comment/{comment}/update',['as'=>'post.comment.update', 'uses'=>'CommentController@postUpdate']);

    Route::get('/test','ProfileController@test');

    Route::group(['prefix' => 'skill', 'as'=>'skill.'], function () {
        Route::get('/',['as'=>'list', 'uses'=>'SkillController@index']);
        Route::get('create',['as'=>'create', 'uses'=>'SkillController@create']);
        Route::get('{skill}/step1',['as'=>'edit.step1', 'uses'=>'SkillController@edit']);
        Route::post('create',['as'=>'add', 'uses'=>'SkillController@add']);
        Route::put('/{skill}/update',['as'=>'update', 'uses'=>'SkillController@update']);

        Route::get('/{skill}/step2',['as'=>'edit.step2', 'uses'=>'SkillController@skillTables']);
        Route::post('/{skill}/experience',['middleware' => 'storage', 'as'=>'add.experience', 'uses'=>'SkillController@addExperience']);
        Route::delete('experience','SkillController@deleteExperience');
        Route::post('experience/update','SkillController@updateExperience');
        Route::post('experience/preview','SkillController@previewExperience');
        Route::post('experience/like','SkillController@likeExperience');

        Route::post('/{skill}/degree',['middleware' => 'storage', 'as'=>'add.degree', 'uses'=>'SkillController@addDegree']);
        Route::delete('degree','SkillController@deleteDegree');
        Route::post('degree/update','SkillController@updateDegree');
        Route::post('degree/preview','SkillController@previewDegree');
        Route::post('degree/like','SkillController@likeDegree');

        Route::post('/{skill}/honor',['middleware' => 'storage', 'as'=>'add.honor', 'uses'=>'SkillController@addHonor']);
        Route::delete('honor','SkillController@deleteHonor');
        Route::post('honor/update','SkillController@updateHonor');
        Route::post('honor/preview','SkillController@previewHonor');
        Route::post('honor/like','SkillController@likeHonor');

        Route::post('/{skill}/history',['middleware' => 'storage', 'as'=>'add.history', 'uses'=>'SkillController@addHistory']);
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

        Route::post('/{skill}/gallery',['middleware' => 'storage', 'as'=>'add.gallery', 'uses'=>'SkillController@addGallery']);
        Route::delete('gallery','SkillController@deleteGallery');
        Route::post('gallery/update','SkillController@updateGallery');

        Route::post('/{skill}/service',['as'=>'add.service', 'uses'=>'SkillController@addService']);
        Route::delete('service','SkillController@deleteService');
        Route::post('service/update','SkillController@updateService');

        Route::post('{skill}/recommendation', ['as'=>'recommendation.store', 'uses'=>'RecommendationController@store']);

        Route::post('{skill}/endorse', ['as'=>'endorse.store', 'uses'=>'EndorseController@store']);
    });


    /**
     * Created By Dara on 30/10/2015
     * handling the group routes
     */
    Route::group(['prefix' => 'group', 'as' => 'group.'], function () {
        Route::get('groups/list', ['as' => 'list', 'uses' => 'GroupController@allGroups']);
        Route::get('create', ['as' => 'create', 'uses' => 'GroupController@create']);
        Route::post('create', ['as' => 'store', 'uses' => 'GroupController@store']);
        Route::get('/{group}/edit', ['as' => 'edit', 'uses' => 'GroupController@edit']);
        Route::post('/{group}/edit', ['as' => 'update', 'uses' => 'GroupController@update']);
        Route::get('/{group}/delete', ['as' => 'delete', 'uses' => 'GroupController@delete']);

    });

    /**
     * Created by Emad Mirzaie on 06/10/2015.
     * Current user friends list, your pending friend requests, new request and find friend
     */
    Route::get('/friends',['as'=>'friends', 'uses'=>'FriendController@index']);
    Route::get('/friends/requests',['as'=>'friends.requests', 'uses'=>'FriendController@requests']);
    Route::get('/friends/pending',['as'=>'friends.pending', 'uses'=>'FriendController@pending']);
    Route::get('/friend/find',['as'=>'friend.find', 'uses'=>'FriendController@find']);
    Route::delete('/friend/unfriend',['uses'=>'FriendController@unFriend']);
    Route::post('/friend/accept',['uses'=>'FriendController@accept']);
    Route::post('/friend/requestslist',['uses'=>'FriendController@requestsList']);

    /**
     * Created By Dara on 30/10/2015
     * show the list of the coupons that have been bought by him/her self
     * and related handling routes
     */
    Route::get('coupons/bought', ['as' => 'coupons.bought', 'uses' => 'CouponController@boughtList']);

    /**
     * Created by Emad Mirzaie on 02/09/2015.
     * Settings of user profiles and account
     */
    Route::group(['prefix' => 'setting', 'as'=>'setting.'], function () {
        Route::get('/password',['as'=>'password', 'uses'=>'SettingController@password']);
        Route::post('/password',['as'=>'changePassword', 'uses'=>'SettingController@changePassword']);
        Route::get('/storage',['as'=>'storage', 'uses'=>'SettingController@storage']);
    });

    Route::group(['prefix' => 'management', 'as'=>'management.'], function () {
        Route::get('/accountant',['as'=>'accountant', 'uses'=>'PaymentController@index']);
        Route::get('/addon/storage',['as'=>'addon.storage', 'uses'=>'AddonsController@storage']);

        /**
         * Created By Dara on 20/10/2015
         * handling offer management routes
         */
        Route::get('/addon/offer',['as'=>'addon.offer','uses'=>'AddonsController@offer']);
        Route::post('/addon/offer/create',['as'=>'addon.offer.create','uses'=>'OfferController@create']);
        Route::get('/addon/offer/{offer}/edit',['as'=>'addon.offer.edit','uses'=>'OfferController@edit']);
        Route::get('addon/offer/services/show', ['as' => 'addon.offer.services.show', 'uses' => 'OfferController@showServices']);
        Route::get('addon/offer/service/{service}/editService', ['as' => 'addon.offer.service.edit', 'uses' => 'OfferController@editService']);
        Route::post('/addon/offer/{offer}/edit/service/create',['as'=>'addon.offer.service.create','uses'=>'OfferController@create']);
        Route::post('/addon/offer/{offer}/coupon/create',['as'=>'addon.offer.service.coupon.create','uses'=>'CouponController@create']);
        Route::post('/addon/offer/coupon/update',['as'=>'addon.offer.coupon.update','uses'=>'CouponController@update']);
        Route::delete('/offer/coupon','CouponController@delete');
        Route::get('/addon/offer/coupons/sold',['as'=>'addon.offer.coupons.list','uses'=>'CouponController@soldCoupons']);
        Route::post('/addon/offer/coupon/{coupon_user}/sold', 'CouponController@sold');

        Route::get('/addon/poll',['as'=>'addon.poll', 'uses'=>'AddonsController@poll']);
        Route::post('/addon/poll/parameter/update',['as'=>'addon.poll.parameter.update', 'uses'=>'pollController@parameterUpdate']);
        Route::get('/addon/poll/{poll}/edit',['as'=>'addon.poll.edit', 'uses'=>'pollController@edit']);
        Route::post('/addon/poll/{poll}/update',['as'=>'addon.poll.update', 'uses'=>'pollController@update']);
        Route::post('/addon/poll/{poll}/parameter/add',['as'=>'addon.poll.parameter.add', 'uses'=>'pollController@parameterAdd']);
        Route::delete('/addon/poll/parameter/delete',['as'=>'addon.poll.parameter.delete', 'uses'=>'pollController@parameterDelete']);
        Route::get('/addon/poll/{poll}/publish',['as'=>'addon.poll.publish', 'uses'=>'pollController@publish']);

        Route::get('/addon/questionnaire',['as'=>'addon.questionnaire', 'uses'=>'AddonsController@questionnaire']);
        Route::post('/addon/questionnaire/question/update',['as'=>'addon.questionnaire.question.update', 'uses'=>'QuestionnaireController@questionUpdate']);
        Route::delete('/addon/questionnaire/question/delete',['as'=>'addon.questionnaire.question.delete', 'uses'=>'QuestionnaireController@questionDelete']);
        Route::get('/addon/questionnaire/{questionnaire}/edit',['as'=>'addon.questionnaire.edit', 'uses'=>'QuestionnaireController@edit']);
        Route::post('/addon/questionnaire/{questionnaire}/update',['as'=>'addon.questionnaire.update', 'uses'=>'QuestionnaireController@update']);
        Route::post('/addon/questionnaire/{questionnaire}/question/add',['as'=>'addon.questionnaire.question.add', 'uses'=>'QuestionnaireController@questionAdd']);
//        Route::delete('/addon/poll/parameter/delete',['as'=>'addon.poll.parameter.delete', 'uses'=>'pollController@parameterDelete']);
        Route::get('/addon/questionnaire/{questionnaire}/publish',['as'=>'addon.questionnaire.publish', 'uses'=>'QuestionnaireController@publish']);
        Route::get('/addon/questionnaire/{questionnaire}/export',['as'=>'addon.questionnaire.export', 'uses'=>'QuestionnaireController@export']);

        Route::get('/addon/shop',['as'=>'addon.shop', 'uses'=>'AddonsController@shop']);

        Route::get('/addon/shop/{shop}/edit',['as'=>'addon.shop.edit', 'uses'=>'ShopController@edit']);
        Route::post('/addon/shop/{shop}/update',['as'=>'addon.shop.update', 'uses'=>'ShopController@update']);
        Route::post('/addon/shop/{shop}/advantage',['as'=>'addon.shop.advantage', 'uses'=>'ShopController@advantage']);
        Route::get('/addon/shop/{shop}/images',['as'=>'addon.shop.images', 'uses'=>'ShopController@images']);
        Route::post('/addon/shop/{shop}/images/store',['as'=>'addon.shop.images.store', 'uses'=>'ShopController@imagesStore']);
        Route::delete('/addon/shop/images/delete',['as'=>'addon.shop.images.delete', 'uses'=>'ShopController@imagesDelete']);

        Route::get('/addon/shop/{shop}/products',['as'=>'addon.shop.products', 'uses'=>'ProductController@index']);
        Route::get('/addon/shop/{shop}/product/create',['as'=>'addon.shop.product.create', 'uses'=>'ProductController@create']);
        Route::post('/addon/shop/{shop}/product/store',['as'=>'addon.shop.product.store', 'uses'=>'ProductController@store']);
        Route::get('/addon/shop/{shop}/product/{product}/edit/step1',['as'=>'addon.shop.product.edit.step1', 'uses'=>'ProductController@step1']);
        Route::post('/addon/shop/{shop}/product/{product}/update',['as'=>'addon.shop.product.update', 'uses'=>'ProductController@update']);
        Route::get('/addon/shop/{shop}/product/{product}/edit/step2',['as'=>'addon.shop.product.edit.step2', 'uses'=>'ProductController@step2']);
        Route::post('/addon/shop/{shop}/product/{product}/attributes',['as'=>'addon.shop.product.attributes', 'uses'=>'ProductController@attributes']);
        Route::delete('/addon/shop/product/attribute/delete',['as'=>'addon.shop.product.attribute.delete', 'uses'=>'ProductController@attributeDelete']);
        Route::get('/addon/shop/{shop}/product/{product}/edit/step3',['as'=>'addon.shop.product.edit.step3', 'uses'=>'ProductController@step3']);
        Route::post('/addon/shop/{shop}/product/{product}/images',['as'=>'addon.shop.product.images', 'uses'=>'ProductController@images']);
        Route::delete('/addon/shop/product/image/delete',['as'=>'addon.shop.product.image.delete', 'uses'=>'ProductController@imageDelete']);

        Route::get('/addon/shop/{shop}/commercial',['as'=>'addon.shop.commercial', 'uses'=>'ShopController@commercialCreate']);
        Route::post('/addon/shop/{shop}/commercial/store',['as'=>'addon.shop.commercial.store', 'uses'=>'ShopController@commercialStore']);
        Route::delete('/addon/shop/commercial/delete',['as'=>'addon.shop.commercial.delete', 'uses'=>'ShopController@imageDelete']);

        Route::get('/addon/shop/{shop}/aboutus',['as'=>'addon.shop.aboutus', 'uses'=>'ShopController@aboutUs']);
        Route::post('/addon/shop/{shop}/aboutus/update',['as'=>'addon.shop.aboutus.update', 'uses'=>'ShopController@aboutUsUpdate']);

        Route::get('/addon/shop/{shop}/contactus',['as'=>'addon.shop.contactus', 'uses'=>'ShopController@contactUs']);
        Route::post('/addon/shop/{shop}/contactus/update',['as'=>'addon.shop.contactus.update', 'uses'=>'ShopController@contactUsUpdate']);

        Route::post('/addon/shop/summernote/image','ShopController@textareaImage');

        Route::get('/addon/advertise',['as'=>'addon.advertise', 'uses'=>'AddonsController@advertise']);
        Route::get('/addon/advertise/{advertise}/edit',['as'=>'addon.advertise.edit', 'uses'=>'advertiseController@edit']);
        Route::post('/addon/advertise/{advertise}/update',['as'=>'addon.advertise.update', 'uses'=>'advertiseController@update']);

        /**
         * Created By Dara on 6/11/2015
         * managing the credit routes
         */
        Route::get('credit',['as'=>'credit','uses'=>'CreditController@index']);
        Route::get('settles',['as'=>'settle.index','uses'=>'SettleController@index']);
        Route::get('settle/create',['as'=>'settle.create','uses'=>'SettleController@create']);
        Route::post('settle/create',['as'=>'settle.store','uses'=>'SettleController@store']);

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
     * Created By Dara on 6/11/2015
     * credit management routes
     */
    Route::get('credit',['as'=>'credit.index','uses'=>'CreditController@adminIndex']);
    Route::get('credit/settle',['as'=>'settle.index','uses'=>'EventController@index']);
    Route::get('credit/settle/requests',['as'=>'settle.requests','uses'=>'SettleController@seeAllRequests']);
    Route::get('credit/settle/requests/{settle}/edit',['as'=>'settle.edit','uses'=>'SettleController@edit']);
    Route::post('credit/settle/requests/{settle}/edit',['as'=>'settle.update','uses'=>'SettleController@update']);
    Route::get('credit/settle/create',['as'=>'settle.create','uses'=>'EventController@create']);
    Route::post('credit/settle/create',['as'=>'settle.store','uses'=>'EventController@store']);
    Route::get('credit/settle/{event}/delete',['as'=>'settle.delete','uses'=>'EventController@delete']);
    Route::get('credit/{user}/edit',['as'=>'credit.edit','uses'=>'CreditController@edit']);
    Route::post('credit/{user}',['as'=>'credit.update','uses'=>'creditController@update']);



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
 * Created by Emad Mirzaie on 12/10/2015.
 * Store
 */
Route::group(['prefix' => 'store', 'as'=>'store.'], function () {
    Route::get('/',['as'=>'index', 'uses'=>'StoreController@index']);
    Route::get('storage',['as'=>'storage', 'uses'=>'StoreController@storage']);
    Route::post('storage/price','StoreController@storagePriceCalculator');
    Route::get('storage/buy',['as'=>'storage.buy', 'uses'=>'StoreController@storageBuy']);
    Route::any('storage/buy/callback',['as'=>'storage.buy.callback', 'uses'=>'StoreController@storageCallback']);
    Route::any('storage/comment',['as'=>'storage.comment', 'uses'=>'CommentController@storage']);

    /**
     * Created By Dara on 19/10/2015
     * special offer handling routes
     */
    Route::get('offer',['as'=>'offer','uses'=>'StoreController@offer']);
    Route::get('offer/buy',['as'=>'offer.buy','uses'=>'StoreController@offerBuy']);
    Route::any('offer/buy/callback',['as'=>'offer.buy.callback','uses'=>'StoreController@offerCallback']);
    Route::any('offer/comment', ['as' => 'offer.comment', 'uses' => 'CommentController@offer']);

    Route::get('poll',['as'=>'poll', 'uses'=>'StoreController@poll']);
    Route::post('poll/price','StoreController@pollPriceCalculator');
    Route::get('poll/buy',['as'=>'poll.buy', 'uses'=>'StoreController@pollBuy']);
    Route::any('poll/buy/callback',['as'=>'poll.buy.callback', 'uses'=>'StoreController@pollCallback']);
    Route::any('poll/comment',['as'=>'poll.comment', 'uses'=>'CommentController@poll']);


    Route::get('questionnaire',['as'=>'questionnaire', 'uses'=>'StoreController@questionnaire']);
    Route::post('questionnaire/price','StoreController@questionnairePriceCalculator');
    Route::get('questionnaire/buy',['as'=>'questionnaire.buy', 'uses'=>'StoreController@questionnaireBuy']);
    Route::any('questionnaire/buy/callback',['as'=>'questionnaire.buy.callback', 'uses'=>'StoreController@questionnaireCallback']);
    Route::any('questionnaire/comment',['as'=>'questionnaire.comment', 'uses'=>'CommentController@questionnaire']);

    Route::get('shop',['as'=>'shop', 'uses'=>'StoreController@shop']);
    Route::get('shop/buy',['as'=>'shop.buy', 'uses'=>'StoreController@shopBuy']);
    Route::any('shop/buy/callback',['as'=>'shop.buy.callback', 'uses'=>'StoreController@shopCallback']);
    Route::any('shop/comment',['as'=>'shop.comment', 'uses'=>'CommentController@shop']);

    Route::get('advertise',['as'=>'advertise', 'uses'=>'StoreController@advertise']);
    Route::post('advertise/price','StoreController@advertisePriceCalculator');
    Route::get('advertise/buy',['as'=>'advertise.buy', 'uses'=>'StoreController@advertiseBuy']);
    Route::any('advertise/buy/callback',['as'=>'advertise.buy.callback', 'uses'=>'StoreController@advertiseCallback']);
    Route::any('advertise/comment',['as'=>'advertise.comment', 'uses'=>'CommentController@advertise']);

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

    Route::group(['prefix' => 'notification', 'as'=>'notification.'], function () {
        Route::get('num',['as'=>'num', 'uses'=>'Api\NotificationController@num']);
    });
});


/**
 * Created by Emad Mirzaie on 12/09/2015.
 * FileS managment and upload
 */
Route::group(['prefix' => 'files', 'as'=>'files.'], function () {
    Route::post('uploader',['as'=>'uploader', 'uses'=>'FilesController@upload']);
    Route::post('attachment',['middleware' => 'storage', 'as'=>'attachment', 'uses'=>'FilesController@attachment']);
    Route::delete('attachment',['as'=>'attachment.delete', 'uses'=>'FilesController@deleteAttachment']);

    Route::post('article',['middleware' => 'storage', 'as'=>'article.attachment', 'uses'=>'FilesController@articleAttachment']);
    Route::post('article/uploader',['as'=>'article.uploader', 'uses'=>'FilesController@articleUpload']);
    Route::delete('article',['as'=>'article.attachment.delete', 'uses'=>'FilesController@deleteArticleAttachment']);

    Route::post('problem/attachment',['as'=>'problem.attachment', 'uses'=>'problemController@attachment']);
});
