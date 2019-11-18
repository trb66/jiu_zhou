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
    //显示分类列表
    Route::get('types', 'Admin\TypesController@index'); //显示分类列表

    //分类
    Route::get('types/add', 'Admin\TypesController@add'); //显示添加顶级分类页面

    Route::post('types/store', 'Admin\TypesController@store'); //传递顶级分类
    
    Route::post('types/del', 'Admin\TypesController@del'); //删除分类

    Route::get('types/red', 'Admin\TypesController@red'); //编辑分类
    
    Route::post('types/edit', 'Admin\TypesController@edit'); //提交修改好的分类

    Route::get('types/addSon', 'Admin\TypesController@addSon'); //显示添加子级页面
    
    Route::post('types/addSub', 'Admin\TypesController@addSub'); //提交子集数据

    //商品
    Route::get('goods', 'Admin\GoodsController@index'); //显示商品列表

    Route::get('goods/goodsAdd', 'Admin\GoodsController@goodsAdd'); //显示添加商品列表

    Route::post('goods/addSub', 'Admin\GoodsController@addSub'); //提交商品数据

    Route::get('goods/edit', 'Admin\GoodsController@edit'); //编辑商品

    Route::post('goods/editSub', 'Admin\GoodsController@editSub'); //编辑商品

    Route::post('goods/del', 'Admin\GoodsController@del'); //删除商品

    //商品图片
    Route::get('imgs', 'Admin\ImgsController@index'); //显示商品图片

    Route::get('imgs/add', 'Admin\ImgsController@add'); //添加图片

    Route::post('imgs/addSub', 'Admin\ImgsController@addSub'); //上传图片

    Route::post('imgs/del', 'Admin\ImgsController@del'); //删除商品图片

    //规格
    Route::get('specsItems', 'Admin\SpecsItemsController@index'); //显示模型规格

    Route::get('specsItems/add', 'Admin\SpecsItemsController@add'); //添加模型
    
    Route::post('specsItems/addSub', 'Admin\SpecsItemsController@addSub'); //添加模型

    //商品添加规格
    Route::get('goodsPrices', 'Admin\GoodsPricesController@index'); //显示商品添加页面
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


