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
    return view('Home/userinfo');
});

/**
* 后台路由组
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'Admin\IndexController@index'); // 后台首页
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


