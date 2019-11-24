<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Slideshows;
use App\Model\Home\Blogrolls;
use App\Model\Home\Types;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //轮播和友链
    public function index()
    {
        //轮播数据
        $model = new Slideshows;
        $res = $model->sel();

        //友链数据
        $friend = new Blogrolls;
        $arr = $friend->find();

        //分类和商品数据
        $types = new Types;
        $str = $types->select();

        $id = session('adminInfo');
        $shopcart = DB::table('shop_cars')->where('uid','=',$id)->get();

        return view('Home/main',[
            'res' => $res,
            'arr' => $arr,
            'str' => $str,
        ]);
    }

    //搜索
    public function search()
    {
        $model = new Types;
        $list = $model->search($_GET['name']);
        foreach ($list as $v) {
            $res = DB::table('types')->where('id','=',$v->cid)->first();
        }
        return view('Home/goods_list',[
            'list' => $list,
            'type' => $res
        ]);
    }
}