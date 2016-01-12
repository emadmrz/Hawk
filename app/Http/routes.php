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
Route::get('/','IndexController@invitation');
Route::post('/',['as'=>'invitation.register','uses'=>'IndexController@invitationRegister']);
Route::get('/coupon', function(){
    return view('store.offer.coupon');
});



Route::get('/sock', function(){
    Event::fire(new \App\Events\sendMessage());
    return 'Event Fired';
});

Route::get('/socket', function(){
    return view('socket');
});

/**
 * Created by Emad Mirzaie on 02/09/2015.
 * Home Routes in this page user receive new feeds
 * also it's a group with home prefix
 */
Route::group(['prefix' => 'home', 'as'=>'home.'], function () {
    Route::get('', ['middleware'=>['auth'], 'as'=>'home', 'uses'=>'HomeController@index']);
    Route::get('/profile/{profile}', ['as'=>'profile', 'uses'=>'HomeController@profile']);
    Route::get('/profile/{profile}/showcase', ['as'=>'profile.showcase', 'uses'=>'ShowcaseController@create']);
    Route::get('/profile/{profile}/article', ['as'=>'articles', 'uses'=>'ArticleController@otherList']);
    Route::get('/profile/{profile}/article/{article}/preview', ['as'=>'article.preview', 'uses'=>'ArticleController@otherPreview']);

    /**
     * Created By Dara on 21/12/2015
     * skill preview
     */
    Route::get('/profile/{profile}/skill/{skill}/preview',['as'=>'skill.preview','uses'=>'SkillController@skillPreview']);

    Route::get('/profile/{profile}/post/{post}/preview',['as'=>'post.preview', 'uses'=>'PostController@otherPreview']);
    Route::post('/friend/request', ['as'=>'friend.request', 'uses'=>'FriendController@request']);
    Route::post('/friend/suggestRequest', ['as'=>'friend.suggestRequest', 'uses'=>'FriendController@suggestRequest']);
    Route::post('/profile/related','ProfileController@related');
    Route::post('/stream/notification','StreamController@notification');

    Route::get('/profile/{profile}/poll/{poll}/preview',['as'=>'poll.preview', 'uses'=>'PollController@preview']);
    Route::post('/poll/{poll}/preview',['as'=>'poll.vote', 'uses'=>'PollController@vote']);

    /**
     * Created By Dara on 1/12/2012
     * Corporation routes
     */
    Route::group(['prefix'=>'corporation','as'=>'corporation.'],function(){
        Route::get('profile/{profile}/corporation/skill/{skill}/create',['as'=>'create','uses'=>'CorporationController@create']);
    });

    /**
     * Created By Dara on 27/10/2015
     * offer handling
     */
    Route::get('/profile/{profile}/offer/{offer}/coupon/{coupon}/buy',['as'=>'profile.offer.coupon.buy','uses'=>'CouponController@buy']);
    Route::get('/profile/{profile}/offer/{offer}/coupon/{coupon}/invoice',['as'=>'profile.offer.coupon.invoice','uses'=>'CouponController@invoice']);
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

    Route::get('/profile/{profile}/skill',['as'=>'skill.list', 'uses'=>'SkillController@index']);
    Route::get('/profile/{profile}/skill/{skill}/compare',['as'=>'profile.skill.compare', 'uses'=>'SkillController@compare']);
    Route::get('/compare/cancel',['as'=>'compare.cancel', 'uses'=>'SkillController@compareCancel']);

    Route::post('/profile/{profile}/sticky/store',['as'=>'profile.sticky.store', 'uses'=>'StickyController@store']);
    Route::post('/profile/sticky/{sticky}/update',['as'=>'profile.sticky.update', 'uses'=>'StickyController@update']);
    Route::delete('/profile/sticky/{sticky}/delete',['as'=>'profile.sticky.delete', 'uses'=>'StickyController@delete']);

    /**
     * Created By Dara on 4/1/2016
     * recruitment public routes
     */
    Route::get('/profile/{profile}/recruitment/{recruitment}/preview',['as'=>'recruitment.preview','uses'=>'RecruitmentController@publicPreview']);
    Route::post('/profile/{profile}/recruitment/{recruitment}/submit',['as'=>'recruitment.submit','uses'=>'RecruitmentController@submitRecruitment']);

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

    /**
     * Created By Dara on 16/12/2015
     * dashboard route group
     */
    Route::group(['prefix'=>'dashboard','as'=>'dashboard.'],function(){
        Route::get('/',['as'=>'index','uses'=>'DashboardController@index']);
    });

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

    Route::get('/compare',['as'=>'compare', 'uses'=>'ProfileController@compare']);

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
        Route::get('/list', ['as' => 'list', 'uses' => 'GroupController@allGroups']);
        Route::get('create', ['as' => 'create', 'uses' => 'GroupController@create']);
        Route::post('create', ['as' => 'store', 'uses' => 'GroupController@store']);
        Route::get('/{group}/edit', ['as' => 'edit', 'uses' => 'GroupController@edit']);
        Route::post('/{group}/edit', ['as' => 'update', 'uses' => 'GroupController@update']);
        Route::get('/{group}/delete', ['as' => 'delete', 'uses' => 'GroupController@delete']);
        Route::get('/{group}/image/create',['as'=>'image.create','uses'=>'GroupController@createImage']);
        Route::post('/{group}/image/create',['as'=>'image.store','uses'=>'GroupController@storeImage']);

    });

    /**
     * Created by Emad Mirzaie on 06/10/2015.
     * Current user friends list, your pending friend requests, new request and find friend
     */
    Route::get('/friends',['as'=>'friends', 'uses'=>'FriendController@index']);
    Route::get('/friends/requests',['as'=>'friends.requests', 'uses'=>'FriendController@requests']);
    Route::get('/friends/pending',['as'=>'friends.pending', 'uses'=>'FriendController@pending']);
    Route::get('/friend/find',['as'=>'friend.find', 'uses'=>'FriendController@find']);

    /**
     * Created By Dara on 23/11/15
     */
    Route::get('/friends/search',['as'=>"friends.search",'uses'=>'FriendController@searchIndex']);
    Route::post('/friends/search',['as'=>"friends.search.results",'uses'=>'FriendController@search']);
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

        /**
         * Created By Dara on 29/11/2015
         * handling the relater management routes
         */
        Route::get('/addon/relater',['as'=>'addon.relater','uses'=>'AddonsController@relater']);

        /**
         * Created By Dara on 29/11/2015
         * handling the profit management routes
         */
        Route::get('/addon/profit',['as'=>'addon.profit','uses'=>'AddonsController@profit']);


        Route::get('/addon/poll',['as'=>'addon.poll', 'uses'=>'AddonsController@poll']);
        Route::post('/addon/poll/parameter/update',['as'=>'addon.poll.parameter.update', 'uses'=>'pollController@parameterUpdate']);
        Route::get('/addon/poll/{poll}/edit',['as'=>'addon.poll.edit', 'uses'=>'pollController@edit']);
        Route::post('/addon/poll/{poll}/update',['as'=>'addon.poll.update', 'uses'=>'pollController@update']);
        Route::post('/addon/poll/{poll}/parameter/add',['as'=>'addon.poll.parameter.add', 'uses'=>'pollController@parameterAdd']);
        Route::delete('/addon/poll/parameter/delete',['as'=>'addon.poll.parameter.delete', 'uses'=>'pollController@parameterDelete']);
        Route::get('/addon/poll/{poll}/contributors',['as'=>'addon.poll.select', 'uses'=>'pollController@select']);
        Route::post('/addon/poll/{poll}/contributors',['as'=>'addon.poll.search', 'uses'=>'pollController@search']);
        Route::post('/addon/poll/{poll}/publish',['as'=>'addon.poll.publish', 'uses'=>'pollController@publish']);

        Route::get('/addon/questionnaire',['as'=>'addon.questionnaire', 'uses'=>'AddonsController@questionnaire']);
        Route::post('/addon/questionnaire/question/update',['as'=>'addon.questionnaire.question.update', 'uses'=>'QuestionnaireController@questionUpdate']);
        Route::delete('/addon/questionnaire/question/delete',['as'=>'addon.questionnaire.question.delete', 'uses'=>'QuestionnaireController@questionDelete']);
        Route::get('/addon/questionnaire/{questionnaire}/edit',['as'=>'addon.questionnaire.edit', 'uses'=>'QuestionnaireController@edit']);
        Route::post('/addon/questionnaire/{questionnaire}/update',['as'=>'addon.questionnaire.update', 'uses'=>'QuestionnaireController@update']);
        Route::post('/addon/questionnaire/{questionnaire}/question/add',['as'=>'addon.questionnaire.question.add', 'uses'=>'QuestionnaireController@questionAdd']);
//        Route::delete('/addon/poll/parameter/delete',['as'=>'addon.poll.parameter.delete', 'uses'=>'pollController@parameterDelete']);
        Route::get('/addon/questionnaire/{questionnaire}/contributors',['as'=>'addon.questionnaire.select', 'uses'=>'QuestionnaireController@select']);
        Route::post('/addon/questionnaire/{questionnaire}/contributors',['as'=>'addon.questionnaire.search', 'uses'=>'QuestionnaireController@search']);
        Route::post('/addon/questionnaire/{questionnaire}/publish',['as'=>'addon.questionnaire.publish', 'uses'=>'QuestionnaireController@publish']);
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

        Route::get('/addon/showcase/myRequest',['as'=>'addon.showcase.myRequest', 'uses'=>'ShowcaseController@myRequest']);
        Route::get('/addon/showcase/requestToMe',['as'=>'addon.showcase.requestToMe', 'uses'=>'ShowcaseController@requestToMe']);
        Route::get('/addon/showcase/active',['as'=>'addon.showcase.active', 'uses'=>'ShowcaseController@activeRequest']);
        Route::get('/addon/showcase/{showcase}/approve',['as'=>'addon.showcase.approve', 'uses'=>'ShowcaseController@approved']);

        /**
         * Created By Dara on 30/12/2015
         * managing the recruitment addon routes
         */
        Route::get('addon/recruitment',['as'=>'addon.recruitment','uses'=>'AddonsController@recruitment']);
        Route::get('addon/recruitment/{recruitment}/edit',['as'=>'addon.recruitment.edit','uses'=>'RecruitmentController@edit']);
        Route::get('addon/recruitment/{recruitment}/question',['as'=>'addon.recruitment.question','uses'=>'RecruitmentController@editQuestion']);
        Route::post('addon/recruitment/{recruitment}/question/submit',['as'=>'addon.recruitment.question.submit','uses'=>'RecruitmentController@submitQuestion']);
        Route::post('addon/recruitment/{recruitment}/question/add',['as'=>'addon.recruitment.question.add','uses'=>'RecruitmentController@addQuestion']);
        Route::get('addon/recruitment/{recruitment}/finalSubmit',['as'=>'addon.recruitment.finalSubmit','uses'=>'RecruitmentController@finalSubmit']);
        Route::get('addon/recruitment/{recruitment}/preview',['as'=>'addon.recruitment.preview','uses'=>'RecruitmentController@profilePreview']);
        Route::get('addon/recruitment/{recruitment}/preview',['as'=>'addon.recruitment.requester.preview','uses'=>'RecruitmentController@requesterPreview']);
        Route::get('addon/recruitment/{recruitment}/{recruitmentRequester}/preview',['as'=>'addon.recruitment.requester.preview','uses'=>'RecruitmentController@requesterPreview']);
        Route::post('/addon/recruitment/{recruitment}/job/create',['as'=>'addon.recruitment.job.create','uses'=>'RecruitmentController@create']);

    });

    /**
     * Created By Dara on 11/9/2015
     * handling report routes
     */
    Route::group(['prefix'=>'report','as'=>'report.'],function(){
        Route::get('/',['as'=>'index','uses'=>'ReportController@index']);
        Route::get('create',['as'=>'create','uses'=>'ReportController@create']);
        Route::post('create',['as'=>'store','uses'=>'ReportController@store']);
});

    /**
     * Created By Dara on 11/9/2015
     * handling feedback
     */
    Route::group(['prefix'=>'feedback','as'=>'feedback.'],function(){
        Route::get('/',['as'=>'index','uses'=>'FeedbackController@index']);
        Route::get('create',['as'=>'create','uses'=>'FeedbackController@create']);
        Route::post('create',['as'=>'store','uses'=>'FeedbackController@store']);

    });

    /**
     * Created By Dara on 1/12/2015
     * handling corporation routes
     */
    Route::group(['prefix'=>'corporation','as'=>'corporation.'],function(){
        Route::get('/',['as'=>'list','uses'=>'CorporationController@showAll']);
        Route::get('/{corporation}',['as'=>'index','uses'=>'CorporationController@index']);
        Route::post('/{corporation}',['as'=>'submit','uses'=>'CorporationController@submit']);
        Route::get('/{corporation}/question',['as'=>'question.index','uses'=>'CorporationController@questionIndex']);
        Route::post('/{corporation}/question',['as'=>'question.submit','uses'=>'CorporationController@questionSubmit']);
        Route::get('/{corporation}/question/show',['as'=>'question.show','uses'=>'CorporationController@questionShow']);
    });

    /**
     * Created By Dara on 5/1/2016
     * handling recruitments related to me
     */
    Route::get('recruitment',['as'=>'recruitment','uses'=>'RecruitmentController@recruitmentIndex']);
    Route::post('recruitment',['as'=>'recruitment.search','uses'=>'RecruitmentController@recruitmentSearch']);
    Route::get('recruitment/{recruitment}/requester/{recruitmentRequester}/preview',['as'=>'recruitment.requester.preview','uses'=>'RecruitmentController@publicRequesterPreview']);

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
//Route::group(['middleware'=>['auth', 'role:admin'], 'prefix' => 'admin', 'as'=>'admin.'], function () {
Route::group(['middleware'=>['auth'], 'prefix' => 'admin', 'as'=>'admin.'], function () {
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
    Route::get('credit/{user?}',['as'=>'credit.index','uses'=>'CreditController@adminIndex']);
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
     * Created Bt Dara on 11/9/2015
     * reports handling
     */
    Route::group(['prefix'=>'report','as'=>'report.'],function(){
        Route::get('/',['as'=>'show','uses'=>'ReportController@adminShow']);
        Route::post('/{report}/seen',['as'=>'seen','uses'=>'ReportController@adminSeen']);
        Route::post('/{report}/unseen',['as'=>'unseen','uses'=>'ReportController@adminUnseen']);
    });

    /**
     * Created By Dara on 11/9/2015
     * feedback handling
     */
    Route::group(['prefix'=>'feedback','as'=>'feedback.'],function(){
        Route::get('/',['as'=>'show','uses'=>'FeedbackController@adminShow']);
        Route::post('/{feedback}/seen',['as'=>'seen','uses'=>'FeedbackController@adminSeen']);
        Route::post('/{feedback}/unseen',['as'=>'unseen','uses'=>'FeedbackController@adminUnseen']);
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

    Route::get('/',['as'=>'index', 'uses'=>'Admin\DashboardController@index']);
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
        Route::get('/{user}/select',['as'=>'select', 'uses'=>'Admin\UserController@select']);

        /**
         * Created By Dara on 20/12/2015
         * user-posts admin control
         */
        Route::get('{user}/post',['as'=>'post.index','uses'=>'PostController@adminIndex']);
        Route::get('{user}/post/{post}/change',['as'=>'post.change','uses'=>'PostController@adminChange']);
        Route::get('{user}/post/{post}/delete',['as'=>'post.delete','uses'=>'PostController@adminDelete']);

        /**
         * Created By Dara on 20/12/2015
         * user-articles admin control
         */
        Route::get('{user}/article',['as'=>'article.index','uses'=>'ArticleController@adminIndex']);
        Route::get('{user}/article/{article}/change',['as'=>'article.change','uses'=>'ArticleController@adminChange']);
        Route::get('{user}/article/{article}/delete',['as'=>'article.delete','uses'=>'ArticleController@adminDelete']);

        /**
         * Created By Dara on 20/12/2015
         * user-skills admin control
         */
        Route::get('{user}/skill',['as'=>'skill.index','uses'=>'SkillController@adminIndex']);
        Route::get('{user}/skill/{skill}/change',['as'=>'skill.change','uses'=>'SkillController@adminChange']);
        Route::get('{user}/skill/{skill}/delete',['as'=>'skill.delete','uses'=>'SkillController@adminDelete']);
        Route::get('{user}/skill/{skill}/corporation/',['as'=>'skill.corporation.index','uses'=>'CorporationController@adminIndex']);
        Route::get('{user}/skill/{skill}/corporation/{corporation}/question',['as'=>'skill.corporation.question.index','uses'=>'CorporationController@adminQuestionPreview']);

        /**
         * Created By Dara on 21/12/2015
         * user-comments admin control
         */
        Route::get('{user}/comment',['as'=>'comment.index','uses'=>'CommentController@adminIndex']);
        Route::get('{user}/comment/{comment}/delete',['as'=>'comment.delete','uses'=>'SkillController@adminCommentDelete']);

        /**
         * Created By Dara on 21/12/2015
         * user-problems admin control
         */
        Route::get('{user}/problem',['as'=>'problem.index','uses'=>'ProblemController@adminIndex']);
        Route::get('{user}/problem/{problem}/change',['as'=>'problem.change','uses'=>'ProblemController@adminChange']);
        Route::get('{user}/problem/{problem}/delete',['as'=>'problem.delete','uses'=>'ProblemController@adminDelete']);

        /**
         * Created By Dara on 21/12/2015
         * user-answers admin control
         */
        Route::get('{user}/answer',['as'=>'answer.index','uses'=>'CommentController@adminAnswerIndex']);
        Route::get('{user}/answer/{comment}/delete',['as'=>'answer.delete','uses'=>'SkillController@adminAnswerDelete']);

        /**
         * Created By Dara on 21/12/2015
         * user-groups admin control
         */
        Route::get('{user}/group',['as'=>'group.index','uses'=>'GroupController@adminIndex']);
        Route::get('{user}/group/{group}/change',['as'=>'group.change','uses'=>'GroupController@adminChange']);
        Route::get('{user}/group/{group}/delete',['as'=>'group.delete','uses'=>'GroupController@adminDelete']);

        /**
         * Created By Dara on 22/12/2015
         * user-addon(offer) admin control
         */
        Route::get('{user}/offer',['as'=>'offer.index','uses'=>'OfferController@adminIndex']);
        Route::get('{user}/offer/{offer}/change',['as'=>'offer.change','uses'=>'OfferController@adminChange']);
        Route::get('{user}/offer/{offer}/service',['as'=>'offer.service.index','uses'=>'OfferController@adminServiceIndex']);
        Route::get('{user}/offer/{offer}/service/{service}/coupon',['as'=>'offer.service.coupon.index','uses'=>'OfferController@adminCouponIndex']);
        Route::get('{user}/offer/{offer}/service/{service}/coupon/{coupon}/buyer',['as'=>'offer.service.coupon.buyer.index','uses'=>'OfferController@adminBuyerIndex']);

        /**
         * Created By Dara on 22/12/2015
         * accountant admin control
         */
        Route::get('{user}/accountant',['as'=>'accountant.index','uses'=>'PaymentController@adminIndex']);

        /**
         * Created By Dara on 22/12/2015
         * user-friends management
         */
        Route::get('{user}/friend',['as'=>'friend.index','uses'=>'FriendController@adminFriendIndex']);

        /**
         * Created By Dara on 23/12/2015
         * user-addon (questionnaire) management
         */
        Route::get('{user}/questionnaire',['as'=>'questionnaire.index','uses'=>'QuestionnaireController@adminIndex']);
        Route::get('{user}/questionnaire/{questionnaire}/change',['as'=>'questionnaire.change','uses'=>'QuestionnaireController@adminChange']);

        /**
         * Created By Dara on 25/12/2015
         * user-addon (poll) management
         */
        Route::get('{user}/poll',['as'=>'poll.index','uses'=>'PollController@adminIndex']);
        Route::get('{user}/poll/{poll}/change',['as'=>'poll.change','uses'=>'PollController@adminChange']);

        /**
         * Created By Dara on 25/12/2015
         * user-addon (relater) management
         */
        Route::get('{user}/relater',['as'=>'relater.index','uses'=>'RelaterController@adminIndex']);
        Route::get('{user}/relater/{relater}/change',['as'=>'relater.change','uses'=>'RelaterController@adminChange']);

        /**
         * Created By Dara on 25/12/2015
         * storage management routes
         */
        Route::get('{user}/storage',['as'=>'storage.index','uses'=>'StorageController@adminIndex']);
        Route::get('{user}/storage/{storage}/change',['as'=>'storage.change','uses'=>'StorageController@adminChange']);

        /**
         * Created By Dara on 26/12/2015
         * share management routes
         */
        Route::get('{user}/share',['as'=>'share.index','uses'=>'ShareController@adminIndex']);

        /**
         * Created By Dara on 26/12/2015
         * shop management routes
         */
        Route::get('{user}/shop',['as'=>'shop.index','uses'=>'ShopController@adminIndex']);
        Route::get('{user}/shop/{shop}/change',['as'=>'shop.change','uses'=>'ShopController@change']);
        Route::get('{user}/shop/{shop}/product',['as'=>'shop.product.index','uses'=>'ProductController@adminIndex']);
        Route::get('{user}/shop/{shop}/product/{product}/change',['as'=>'shop.product.change','uses'=>'ProductController@change']);

        /**
         * Created By Dara on 26/12/2015
         * files management routes
         */
        Route::get('{user}/file',['as'=>'file.index','uses'=>'FilesController@adminIndex']);

        /**
         * Created By Dara on 27/12/2015
         * roles management admin control
         */
        Route::get('{user}/role',['as'=>'role.index','uses'=>'RoleController@adminIndex']);
        Route::post('{user}/role',['as'=>'role.submit','uses'=>'RoleController@adminSubmit']);
        Route::get('{user}/role/{role}/detach',['as'=>'role.delete','uses'=>'RoleController@adminDelete']);

        /**
         * Created By Dara on 28/12/2015
         * files management admin control
         */
        Route::get('{user}/file',['as'=>'file.index','uses'=>'FilesController@adminIndex']);

        /**
         * Created By Dara on 28/12/2015
         * addon management admin control
         */
        Route::get('{user}/addon',['as'=>'addon.index','uses'=>'AddonsController@adminIndex']);

        /**
         * Created By Dara on 3/1/2016
         * addon management recruitment control
         */
        Route::get('{user}/recruitment',['as'=>'recruitment.index','uses'=>'RecruitmentController@adminIndex']);
        Route::get('{user}/recruitment/{recruitment}/change',['as'=>'recruitment.change','uses'=>'RecruitmentController@adminChange']);

    });
    /**
     * Created By Dara on 22/12/2015
     * accountant admin control
     */
    Route::get('accountant',['as'=>'accountant.index','uses'=>'PaymentController@adminIndex']);

    /**
     * Created By Dara on 22/12/2015
     * all-groups admin control
     */
    Route::get('group',['as'=>'group.index','uses'=>'GroupController@adminIndex']);
    Route::get('group/{group}/change',['as'=>'group.change','uses'=>'GroupController@adminChange']);
    Route::get('group/{group}/delete',['as'=>'group.delete','uses'=>'GroupController@adminDelete']);

    /**
     * Created By Dara on 23/12/2015
     * announcement management routes
     */
    Route::group(['prefix'=>'announcement','as'=>'announcement.'],function(){
        Route::get('/',['as'=>'index','uses'=>'AnnouncementController@index']);
        Route::get('/create',['as'=>'create','uses'=>'AnnouncementController@create']);
        Route::post('/create',['as'=>'store','uses'=>'AnnouncementController@store']);
        Route::get('/{announcement}/edit',['as'=>'edit','uses'=>'AnnouncementController@edit']);
        Route::post('/{announcement}/update',['as'=>'update','uses'=>'AnnouncementController@update']);
        Route::get('/{announcement}/change',['as'=>'change','uses'=>'AnnouncementController@change']);



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

    /**
     * Created By Dara on 8/12/2015
     * managing staration routes
     */
    Route::group(['prefix'=>'staration','as'=>'staration.'],function(){
        Route::get('/',['as'=>'index','uses'=>'RateController@index']);
        Route::get('/start',['as'=>'start','uses'=>'RateController@rate']);
        Route::get('/{user?}',['as'=>'skill','uses'=>'RateController@skillIndex']);
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

    /**
     * Created By Dara on 27/11/2015
     * Relater addon routes
     */
    Route::get('relater',['as'=>'relater','uses'=>'StoreController@relater']);
    Route::post('relater/price','StoreController@relaterPriceCalculator');
    Route::get('relater/buy',['as'=>'relater.buy','uses'=>'StoreController@relaterBuy']);
    Route::any('relater/buy/callback',['as'=>'relater.buy.callback', 'uses'=>'StoreController@relaterCallback']);
    Route::any('relater/comment',['as'=>'relater.comment', 'uses'=>'CommentController@relater']);

    /**
     * Created By Dara on 28/11/2015
     * Profit addon routes
     */
    Route::get('profit',['as'=>'profit','uses'=>'StoreController@profit']);
    Route::post('profit/price','StoreController@profitPriceCalculator');
    Route::get('profit/buy',['as'=>'profit.buy','uses'=>'StoreController@profitBuy']);
    Route::any('profit/buy/callback',['as'=>'profit.buy.callback', 'uses'=>'StoreController@profitCallback']);
    Route::any('profit/comment',['as'=>'profit.comment', 'uses'=>'CommentController@profit']);

    Route::get('showcase/{showcase}',['as'=>'showcase','uses'=>'StoreController@showcase']);
    Route::get('showcase/{showcase}/buy',['as'=>'showcase.buy','uses'=>'StoreController@showcaseBuy']);
    Route::any('showcase/buy/callback',['as'=>'showcase.buy.callback', 'uses'=>'StoreController@showcaseCallback']);
    Route::any('showcase/comment',['as'=>'showcase.comment', 'uses'=>'CommentController@showcase']);

    /**
     * Created By Dara on 30/12/2015
     * recruitment addon routes
     */
    Route::get('recruitment',['as'=>'recruitment','uses'=>'StoreController@recruitment']);
    Route::get('recruitment/buy',['as'=>'recruitment.buy','uses'=>'StoreController@recruitmentBuy']);
    Route::any('recruitment/buy/callback',['as'=>'recruitment.buy.callback', 'uses'=>'StoreController@recruitmentCallback']);
    Route::any('recruitment/comment',['as'=>'recruitment.comment', 'uses'=>'CommentController@recruitment']);


});


/**
 * Created by Emad Mirzaie on 10/09/2015.
 * Web Api
 */
Route::group(['prefix' => 'api', 'as'=>'api.'], function () {

    Route::group(['prefix' => 'location', 'as'=>'location.'], function () {
        Route::get('cities',['as'=>'cities', 'uses'=>'Api\LocationController@cities']);
    });

    /**
     * Created By Dara on 13/12/2015
     */
    Route::group(['prefix'=>'top','as'=>'top.'],function(){
        Route::get('sort',['as'=>'sort','uses'=>'Api\TopSortController@sort']);
    });

    Route::group(['prefix' => 'category', 'as'=>'category.'], function () {
        Route::get('sub',['as'=>'sub', 'uses'=>'Api\CategoryController@sub']);
        Route::get('tags',['as'=>'tags', 'uses'=>'Api\CategoryController@tags']);
    });

    Route::group(['prefix' => 'notification', 'as'=>'notification.'], function () {
        Route::post('num',['as'=>'num', 'uses'=>'Api\NotificationController@num']);
    });

    Route::group(['prefix' => 'friends', 'as'=>'friends.'], function () {
//        Route::post('/{profile}', 'Api/friendsController@friends');
        Route::post('/online', ['as'=>'online', 'uses'=>'Api\friendsController@online']);
    });

    Route::group(['prefix' => 'like', 'as'=>'like.'], function () {
        Route::post('comment',['as'=>'comment', 'uses'=>'Api\LikeController@comment']);
        Route::post('history',['as'=>'history', 'uses'=>'Api\LikeController@history']);
        Route::post('paper',['as'=>'paper', 'uses'=>'Api\LikeController@paper']);
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

/**
 * Created by Emad Mirzaie on 11/11/2015.
 * Search
 */
Route::group(['prefix' => 'search', 'as'=>'search.'], function () {
    Route::get('/',['as'=>'index', 'uses'=>'SearchController@index']);
    Route::post('fastSearch',['as'=>'fastSearch','uses'=>'SearchController@fastSearch']);
    Route::post('fullSearch',['as'=>'fullSearch','uses'=>'SearchController@search']);
});

Route::group(['prefix' => 'chat', 'as'=>'chat.'], function () {
    Route::get('/{profile?}',['as'=>'index', 'uses'=>'ChatController@index']);
    Route::post('/send/{profile}',['as'=>'send', 'uses'=>'ChatController@send']);
    Route::post('/history',['as'=>'history', 'uses'=>'ChatController@history']);
    Route::post('/typing',['as'=>'typing', 'uses'=>'ChatController@typing']);
    Route::post('/seen',['as'=>'seen', 'uses'=>'ChatController@seen']);
    Route::post('/latest',['as'=>'latest', 'uses'=>'ChatController@latest']);
});

Route::group(['prefix' => 'share', 'as'=>'share.'], function () {
    Route::get('article/{article}',['as'=>'article', 'uses'=>'ShareController@article']);
});

Route::group(['prefix'=>'top','as'=>'top.'],function(){
    Route::get('/user',['as'=>'user','uses'=>'TopController@user']);
    Route::get('/product',['as'=>'user','uses'=>'TopController@product']);
    Route::get('/result',['as'=>'result','uses'=>'TopController@searchProcess']);
});
