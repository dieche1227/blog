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
Route::get('/', 'IndexController@index');
#注册页面
Route::get('register', 'RegisterController@showRegister');
#执行注册
Route::post('doregister', 'RegisterController@doRegister')->middleware('ajax');
#登录页面
Route::get('login', 'LoginController@showLogin');
#执行登录
Route::post('dologin', 'LoginController@doLogin')->middleware('ajax');

#用户执行加入群组操作
Route::post('jiaqun', 'JiaQunController@doJia')->middleware('ajax');

#用户空间，给其他人看该注册用户在本站的信息
Route::get('uzone', 'UzoneController@index');
#用户中心首页显示IFRAME
Route::get('ucenterindex', 'UcenterController@ucenterIndex');
#用户中心首页
Route::get('ucenter', 'UcenterController@index')->middleware('login');
Route::resource('a', 'ActivityController');
Route::resource('q', 'QunController');
Route::resource('articles', 'ArticleController');


Route::get('about', 'IndexController@about');
Route::get('mobanzhuti', 'IndexController@mobanzhuti');
Route::post('picUpload', 'FileController@picUpload');

Route::post('fengmiansave', 'FileController@fengmiansave');














//网站后台路由配置
Route::get('/admin/login',"Admin\UserController@login");//加载登录页
Route::post('/admin/dologin',"Admin\UserController@doLogin");//执行登录
Route::get('/admin/code',"Admin\UserController@code");//加载验证码


//网站后退路由组
Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
    Route::get('/',"Admin\IndexController@index"); //后台首页
    Route::get('/logout',"Admin\UserController@logout"); //后台首页
    Route::resource('stu', 'Admin\StuController'); //后台学员管理
    Route::resource('type', 'Admin\TypeController'); //后台类别管理
    //Route::get('type/aa', 'Admin\TypeController@aa'); //后台类别管理
    Route::resource('article', 'Admin\ArticleController'); //后台博客信息管理

});




