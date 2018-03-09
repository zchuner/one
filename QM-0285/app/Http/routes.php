<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/**
 * Code验证码路由
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Code'], function () {
    Route::get('code/{width}/{height}/{tmp}', 'CodeController@index');
});

Route::group(['middleware' => ['web'], 'prefix' => '/', 'namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@getHome');
    Route::get('/category/{cat_id}/{page}.html', 'IndexController@getCategory');
    Route::get('/category/{cat_id}.html', 'IndexController@getCategory');
    Route::get('/show/{cat_id}/{id}/{page}.html', 'IndexController@getShow');
    Route::get('/show/{cat_id}/{id}.html', 'IndexController@getShow');
    Route::get('/poster/index/{type}', 'IndexController@getPoster');
    Route::get('/hits/{modelId}/{id}', 'IndexController@getHits');
    Route::get('/search', 'SearchController@items');

    Route::post('praise/update', 'IndexController@praiseUpdate');

    Route::get('/special/{id}.html', 'SpecialController@getHome');
    Route::get('/special/category/{id}/{cid}.html', 'SpecialController@getCategory');
    Route::get('/special/category/{id}/{cid}/{page}.html', 'SpecialController@getCategory');
    Route::get('/special/show/{id}/{page}.html', 'SpecialController@getShow');
    Route::get('/special/hits/{id}/{module}', 'SpecialController@getHits');
});

/**
 * 管理员登录/退出入口路由
 */
Route::group(['middleware' => ['web'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
});

/**
 * 后台路由
 */
Route::group(['middleware' => ['web', 'AdminLogin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/index', 'IndexController@index');
    Route::get('/home', 'IndexController@home');
    Route::get('/getMenu/{menuId}', 'IndexController@getMenu');
    Route::get('/getMenuPos/{id}', 'IndexController@getMenuPos');
    Route::get('/getKeywords', 'IndexController@getKeywords');
    Route::get('/getVideoData', 'IndexController@getVideoData');
    Route::any('/extend', 'ExtendController@init');
    Route::any('/upload', 'UploadController@init');
});