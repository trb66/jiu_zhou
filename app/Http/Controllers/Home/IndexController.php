<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Slideshows;
use App\Model\Home\Blogrolls;
use App\Model\Home\Types;

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

        //分类数据
        $types = new Types;
        $str = $types->select();

        $types = new Types;
        $zi = $types->zi();
        // dump($zi);


        return view('Home/index',[
            'res' => $res,
            'arr' => $arr,
            'str' => $str
        ]);
    }
}