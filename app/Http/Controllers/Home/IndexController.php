<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Slideshows;
use App\Model\Home\Blogrolls;

class IndexController extends Controller
{
    //轮播
    public function index()
    {
        $model = new Slideshows;
        $friend = new Blogrolls;
        $res = $model->sel();
        $arr = $friend->find();
        return view('Home/index',[
            'res' => $res,
            'arr' => $arr
        ]);
    }
}
