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

Route::get('/', 'Home\IndexController@index');

/**
* 后台路由组
*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin.login', 'admin.power']], function() {
    Route::get('/', 'Admin\IndexController@index'); // 后台首页
    /**
    *   +-------------------------------------------------------
    *   唐荣博 
    *   +-------------------------------------------------------
    */
    Route::get('/test', 'Admin\AdminController@test');

    Route::post('/test2', 'Admin\AdminController@test2');

    Route::get('/test3', 'Admin\AdminController@tests');

    Route::get('/addAdmin', 'Admin\AdminController@add'); // 添加后台用户

    Route::post('/caddAdmin', 'Admin\AdminController@cadd'); // 处理添加用户 

    Route::get('/adminlist', 'Admin\AdminController@index'); // 后台管理员列表

    Route::get('/adminsel', 'Admin\AdminController@sel'); // 后台管理员列表

    Route::post('/admindel', 'Admin\AdminController@del'); // 后台管理员删除

    Route::post('/admindelall', 'Admin\AdminController@delall'); // 后台管理员删除

    Route::post('/adminstatus', 'Admin\AdminController@status'); // 改变状态

    Route::post('/adminjinall', 'Admin\AdminController@statusall'); // 改变状态
    
    Route::get('/adminedit', 'Admin\AdminController@edit'); // 编辑

    Route::post('/adminedit', 'Admin\AdminController@cedit'); // 处理编辑

    Route::get('/logout', 'Admin\LoginController@logout'); // 处理退出

    Route::get('/addroles', 'Admin\RoleController@addroles'); // 添加角色

    Route::post('/addroles', 'Admin\RoleController@caddroles'); // 处理添加角色

    Route::get('/roleslist', 'Admin\RoleController@index'); // 角色列表

    Route::post('/roledel', 'Admin\RoleController@del'); // 删除角色

    Route::post('/roledelall', 'Admin\RoleController@delall'); // 批量删除角色

    Route::get('/roleedit', 'Admin\RoleController@edit'); // 修改角色

    Route::post('/roleedit', 'Admin\RoleController@cedit'); // 处理修改角色

    Route::get('/addauth', 'Admin\AuthController@addauth'); // 给角色添加权限

    Route::get('/power', 'Admin\PowerController@index'); // 权限列表

    Route::get('/addpower', 'Admin\PowerController@addpower'); // 添加权限

    Route::post('/caddpower', 'Admin\PowerController@caddpower'); // 处理添加权限

    Route::post('/powerdel', 'Admin\PowerController@delone'); // 处理添加权限

    Route::get('/poweredit', 'Admin\PowerController@edit'); // 修改

    Route::post('/poweredit', 'Admin\PowerController@cedit'); // 处理修改

    Route::get('/userlist', 'Admin\UserController@index'); // 前台会员列表

    Route::post('/userstatus', 'Admin\UserController@status'); // 会员修改状态





    





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
/************************轮播图模块************************************/
    //显示轮播图首页
    Route::get('/lunbo','Admin\LunboController@index');
    Route::post('/lunbo','Admin\LunboController@search');
    //轮播图添加功能
    Route::post('/add','Admin\LunboController@add');
    //分页功能
    Route::post('/list','Admin\LunboController@index');
    //显示添加页面
    Route::get('/doadd','Admin\LunboController@doadd');
    //删除轮播图
    Route::post('/lunbo/del','Admin\LunboController@del');
    //显示修改轮播
    Route::get('/edit/{id}','Admin\LunboController@edit');
    //修改
    Route::post('/edit/{id}','Admin\LunboController@save');
    //修改状态
    Route::post('/statuse','Admin\LunboController@statuse');

/************************友链模块************************************/

    //显示友链列表页
    Route::get('/friend','Admin\FriendsController@index');
    //显示添加友链
    Route::get('/add','Admin\FriendsController@doadd');
    //添加友链
    Route::post('/friendadd','Admin\FriendsController@add');
    //删除友链
    Route::post('/friendsdel','Admin\FriendsController@del');
    //修改状态
    Route::post('/friendsta','Admin\FriendsController@statuse');
    //显示编辑页面
    Route::get('/friendedit/{id}','Admin\FriendsController@edit');
    //编辑友链
    Route::post('/friendedit/{id}','Admin\FriendsController@save');

    /**  结束
    *   +-------------------------------------------------------
    */



});
Route::get('/admin/login', 'Admin\LoginController@login'); // 后台登陆首页


Route::post('/admin/sendemail', 'Admin\LoginController@sendemail'); // 发送邮件

Route::get('/admin/send', 'Admin\LoginController@send'); // 发送邮件

Route::post('/admin/chulilogin', 'Admin\LoginController@chulilog'); // 发送邮件


/**
* 前台路由组
*/
Route::group(['prefix' => 'home'], function() {
    /**
    *   +-------------------------------------------------------
    *   唐荣博 
    *   +-------------------------------------------------------
    */


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
