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
      Route::get('/order', 'Admin\OrderController@index'); // 订单列表

      Route::get('/order/search','Admin\OrderController@search');//订单搜索

      Route::post('/order/del','Admin\OrderController@del');//订单删除
      
      Route::post('/order/fahuo','Admin\OrderController@fahuo');//发货

      Route::get('/order/lookorder','Admin\OrderController@look');//订单详情

      Route::get('/order/print','Admin\OrderController@print');//打印
         
      Route::get('/order/alter','Admin\OrderController@alter');//显示订单修改页面

      Route::post('/order/edit','Admin\OrderController@edit');//订单修改

      Route::get('/comments','Admin\CommentsController@index'); //评论列表

      Route::get('/comments/search','Admin\CommentsController@search'); //评论搜索
    
      Route::get('/comments/reply','Admin\CommentsController@reply'); //评论搜索

      Route::post('/comments/addreply','Admin\CommentsController@addreply'); //评论搜索

    
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


