<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
* 后台路由组
*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin.login']], function() {
    Route::get('/', 'Admin\IndexController@index'); // 后台首页
    /**
    *   +-------------------------------------------------------
    *   唐荣博 
    *   +-------------------------------------------------------
    */

    Route::get('/addAdmin', 'Admin\AdminController@add'); // 添加后台用户

    Route::post('/caddAdmin', 'Admin\AdminController@cadd'); // 处理添加用户 

    Route::get('/adminlist', 'Admin\AdminController@index'); // 后台管理员列表

    Route::get('/adminsel', 'Admin\AdminController@sel'); // 后台管理员列表

    Route::post('/admindel', 'Admin\AdminController@del'); // 后台管理员删除

    Route::post('/admindelall', 'Admin\AdminController@delall'); // 后台管理员删除

    Route::post('/adminstatus', 'Admin\AdminController@status'); // 改变状态

    Route::get('/adminedit', 'Admin\AdminController@edit'); // 编辑

    Route::post('/adminedit', 'Admin\AdminController@cedit'); // 处理编辑

    Route::get('/logout', 'Admin\LoginController@logout'); // 处理退出

    Route::get('/addroles', 'Admin\RoleController@addroles'); // 添加角色

    Route::post('/addroles', 'Admin\RoleController@caddroles'); // 处理添加角色






    





    /** 结束
    *   +-------------------------------------------------------
    */




    /**
    *   +-------------------------------------------------------
    *   刘贵泽 
    *   +-------------------------------------------------------
    */




    /** 结束
    *   +-------------------------------------------------------
    */




    /**
    *   +-------------------------------------------------------
    *   周双峰 
    *   +-------------------------------------------------------
    */  


    /** 结束
    *   +-------------------------------------------------------
    */




    /**
    *   +-------------------------------------------------------
    *   宋奕 
    *   +-------------------------------------------------------
    */


    /**  结束
    *   +-------------------------------------------------------
    */



});
Route::get('/admin/login', 'Admin\LoginController@login'); // 后台登陆首页


Route::post('/admin/sendemail', 'Admin\LoginController@sendemail'); // 发送邮件

Route::get('/admin/send', 'Admin\LoginController@send'); // 发送邮件

Route::post('/admin/chulilogin', 'Admin\LoginController@chulilog'); // 发送邮件



