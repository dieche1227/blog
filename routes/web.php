<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//短信验证码
Route::get('msgcode','CodeController@msgCode');
//图形验证码
Route::get('graphcode','CodeController@graphCode');


//七牛TOKEN
Route::resource('qiniu1','QiniuController');

//地区
Route::resource('area','AreaController');

//为商品添加和删除用户
Route::resource('goodsuser','GoodsUserController');

//为商品添加删除参数
Route::resource('goodsparam','Home\GoodsParamController');

//为商品添加用户时，用户需要填的参数
Route::resource('goodsuserparam','Home\GoodsUserParamController');

//用户注册页
Route::resource('register','Home\UserController@create');
//创建用户
Route::resource('create','Home\UserController@store');
//用户登录
Route::resource('login','Home\LoginController');





//重置密码
Route::resource('resetpassword','Home\ResetpasswordController');
//首页展示商品
Route::resource('/goods','Home\GoodsController');

//首页展示商品
Route::resource('/article','Home\ArticleController');









Route::resource('/admin/login', 'Admin\LoginController'); //login管理





Route::resource('/admin/goods', 'Admin\GoodsController');

Route::resource('/admin/plan','Admin\PlanController');





//网站后退路由组
Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
    Route::get('/',"Admin\IndexController@index"); //后台首页
    Route::get('/logout',"Admin\UserController@logout"); //后台首页
    Route::resource('stu', 'Admin\StuController'); //后台学员管理
    Route::resource('type', 'Admin\TypeController'); //后台类别管理
    //Route::get('type/aa', 'Admin\TypeController@aa'); //后台类别管理
    Route::resource('article', 'Admin\ArticleController'); //后台博客信息管理
});




