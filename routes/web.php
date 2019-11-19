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
    return view('Home/index');
});

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



