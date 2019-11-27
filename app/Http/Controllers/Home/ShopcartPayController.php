<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Home\Shop_cars;

class ShopcartPayController extends Controller
{
    //提交订单
    public function index(Request $request)
    {
        $id = $request->input('id');

        $cars = DB::table('shop_cars')->wherein('id', $id)->update(['selected' => 1]); 
        if($cars) {
            return ['yes'];
        }else {
            return response()->json([
                 'code' => 1,
                 'msg' => '服务器错误'
            ],500);
        }
    }

    //跳到订单页面
    public function shopcarPay()
    {
       
        $uid = session()->get('UserInfo')['id'];
        $res = new Shop_cars;
        $carsOne = $res->carsOne($uid);
        $addrs = DB::table('addrs')->where('uid', $uid)->orderBy('acquiescent', 'desc')->get();
        return view('/Home/shopcart_pay', ['cars' => $carsOne, 'addrs' => $addrs]);
    }
    
    //修改默认地址
    public function addrsSta(Request $request)
    {  
        $uid = session()->get('UserInfo')['id'];
        $id = $request->input();
        //修改当前选择的地址状态为默认
        $addrs = DB::table('addrs')->where('uid', $uid)->where('id', '<>', $id)->update(['acquiescent'=> 0]);
        $addrssta = DB::table('addrs')->where('uid', $uid)->where('id', $id)->update(['acquiescent'=> 1]);
        //修改除了当前选择的地址外其他地址都不是默认的
        if($addrssta != null) {
            return ['yes'];
        } else {
            return response()->json([
                 'code' => 1,
                 'msg' => '服务器错误'
            ],500);
        }
    }

    //提交订单
    public function pay(Request $request)
    {
        $uid = session()->get('UserInfo')['id'];
        $addrsID = $request->input('id');
        $sum = $request->input('sum');
        $addrs = DB::table('addrs')->where('id', $addrsID)->first();
        $res = new Shop_cars;
        $cars = $res->carsOne($uid);
        $cardel = DB::table('shop_cars')->where('uid', $uid)->where('selected', 1)->sharedLock()->delete();
        if($cardel != null) {
            $data = [
                'uid' => $uid, 
                'username' => $addrs->username,
                'phone' => $addrs->phone,
                'address' => $addrs->address.'-'.$addrs->addrinfo,
                'total_price' => $sum,
                'status' => '0'
            ];
            
            //将用户地址写进订单表,bing返回ID
            $orders = DB::table('orders')->sharedLock()->insertGetId($data);
            //生成一个订单编号
            $oid = date('YmdHis').$orders;
                  // 插入订单详情表
            foreach ($cars as $val) {
                 $ordeData = [
                   'oid' => $orders,
                   'gid' => $val->prices->goods_id,
                   'sid' => $val->prices->id,
                   'orders' => $oid,
                   'num' => $val->commod,
                   'name' => $val->prices->goods_name->name,
                   'price' => $val->prices->price
                   
                  ];
                 DB::table('orders_detail')->sharedLock()->insert($ordeData); 
             }
             return response()->json([
                      'code' => 0,
                      'oid' => $oid,
                      'price' => $sum
             ],200);
        }else {
            return response()->json([
                 'code' => 1,
                 'msg' => '服务器错误'
            ],500);
        }





        //删除下单的购物车数据
        // dump($orders);
        

        

    }


}
