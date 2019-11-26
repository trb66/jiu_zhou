<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Home\Shop_cars;

class ShopcartController extends Controller
{
    //显示购物车页面
    public function index()
    {
        $user = session()->get('UserisLogin');
        // 判断用户是否登陆
        if($user){
                    $uid = session()->get('UserInfo')['id'];

                    $cars = new Shop_cars;
                    //得到该用户的所有订单
                    $res = $cars->seek($uid);
                     // dd($res);
                 if($res) {

                    echo 123;
                     $spec_id = [];
                     foreach ($res as $key => $v) {
                        $spec_id[$key] = $v->spec_id;
                        }
                    $spec = DB::table('spec_goods_prices')->wherein('id', $spec_id)->get();
                     
                   $goods_id = [];
                     foreach ($spec as $key => $v) {
                         $goods_id[$key] = $v->goods_id;
                     }
                   $goods = DB::table('goods')->wherein('id', $goods_id)->get();
                   // $imgs = DB::table('imgs')->wherein('goods_id', $goods_id)->get()->toArray();
                   //拿出每个商品的图片的数据
                   $imgs = [];
                   foreach ($goods as $key => $v) {
                        $imgs[$key] = DB::table('imgs')->where('goods_id', $v->id)->first();
 
                   }
                        dump($imgs);

                   

                   return view('/Home/shopcart', ['res' => $res, 'spec' => $spec ]);     
                    
                 }else {
                   
                   return view('/Home/shopcart');     

             } 
        
        //   dump($spec_id);
        // //存商品表信息
         // $goods = $cars->goods($goods_id);
         // $imgs_id = [];
         // foreach ($goods as $key => $v) {
         //     $imgs_id[$key] = $v->id;
         // }
          
         //存图片信息
         // $imgs = $cars->imgs($imgs_id);
         // dump($imgs);
            }else {
               return "请先登陆";
        }
    }
}