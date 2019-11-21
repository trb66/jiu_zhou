<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;//M
use App\Model\Home\Goods;

class GoodsController extends Controller
{
    public function index($id)
    {
        $model = new Goods;
        $list = $model->sel($id);
        foreach ($list as $v) {
            $res = DB::table('types')->where('id','=',$v->cid)->first();
        }
        return view('Home/goods_list',[
            'list' => $list,
            'type' => $res
        ]);
    }
    //搜索
    public function search()
    {
        $model = new Goods;
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