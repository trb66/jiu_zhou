<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Home\Goods;
use App\Model\Home\Types;


class GoodsController extends Controller
{
    public function index($id)
    {
        $model = new Goods;
        $list = $model->sel($id);
        //统计当前3级分类下共有多少商品
        $count = DB::table('goods')->where('cid','=',$id)->count();

        //查出当前3级分类
        $type = Types::where('id','=',$id)->first();
        // dd($type);
        return view('Home/goods_list',[
            'list' => $list,
            'count' => $count,
            'type' => $type,

        ]);
    }
    //搜索
    public function search()
    {
        $model = new Goods;
        $list = $model->search($_GET['name']);

        return view('Home/goods_search',[
            'list' => $list
        ]);
    }

    //销量排序(降序)
    public function orders($id)
    {
        $model = new Goods;
        $orders = $model->orders($id);
        $count = DB::table('goods')->where('cid','=',$id)->count();
        $type = Types::where('id','=',$id)->first();

        return view('Home/goods_list',[
            'list' => $orders,
            'count' => $count,
            'type' => $type,
        ]);
    }
    //价格排序
    public function price($id)
    {
        $model = new Goods;
        $price = $model->price($id);
        $count = DB::table('goods')->where('cid','=',$id)->count();
        $type = Types::where('id','=',$id)->first();

        return view('Home/goods_list',[
            'list' => $price,
            'count' => $count,
            'type' => $type,
        ]);
    }

    //价格组搜索
    public function group($id)
    {
        $model = new Goods;
        $res = $model->group($id);
        $count = DB::table('goods')->where('cid','=',$id)->count();
        $type = Types::where('id','=',$id)->first();
        return view('Home/goods_list',[
            'list' => $res,
            'count' => $count,
            'type' => $type,

        ]);
    }
}