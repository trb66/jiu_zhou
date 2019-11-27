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

            $uid = session()->get('UserInfo')['id'];

            $cars = new Shop_cars;
            //得到该用户的所有订单
            $res = $cars->seek($uid);
            //判断用户是否用订单   
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

           return view('/Home/shopcart', ['res' => $res, 'spec' => $spec, 'goods' => $goods, 'imgs' =>  $imgs]);   
        
          
        
    }

    //商品数量的增删
    public function commod(Request $request)
    {
        $id =$request->input('id');
        $commod = $request->input('commod');
        DB::table('shop_cars')->where('id', $id)->update(['commod'=> $commod]);
    }
    
    //删除购物车商品
    public function shopDel(Request $request)
    {
         $id = $request->all();
         $cars = DB::table('shop_cars')->where($id)->delete();
         if($cars) {
            return 'yes';
         } else {
           return response()->json([
                 'code' => 1,
                 'msg' => '服务器错误'
            ],500);
         }
    }  

    //删除选中的多样商品
    public function qdel(Request $request)
    {
        $ids = $request->all();
        $car = DB::table('shop_cars')->wherein('id', $ids)->delete();
        dump($car);
        if($car) {
          return 'yes';
        } else {
          return response()->json([
                 'code' => 1,
                 'msg' => '服务器错误'
            ],500);
        }
    }
}
