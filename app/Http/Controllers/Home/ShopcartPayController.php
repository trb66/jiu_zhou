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
        $uid = session()->get('UserInfo')['id'];
        DB::table('shop_cars')->where('uid', $uid)->whereNotIn('id', $id)->update(['selected' => 0]);
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

         //查询购物车数量
        $id = session('UserInfo')['id'];
        $shopcart = DB::table('shop_cars')->where('uid','=',$id)->where('selected','=','0')->count();
        return view('/Home/shopcart_pay', ['cars' => $carsOne, 'addrs' => $addrs, 'numm' => $shopcart]);
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
            //生成一个订单编号
            $str = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            $data = [
                'uid' => $uid, 
                'username' => $addrs->username,
                'phone' => $addrs->phone,
                'address' => $addrs->address.'-'.$addrs->addrinfo,
                'orders' =>  $str,
                'total_price' => $sum,
                'status' => '0'
            ];
            
            //将用户地址写进订单表,bing返回ID
            $orders = DB::table('orders')->sharedLock()->insertGetId($data);
            // 插入订单详情表
            foreach ($cars as $val) {
                 $ordeData = [
                   'oid' => $orders,
                   'gid' => $val->prices->goods_id,
                   'sid' => $val->prices->id,
                   'num' => $val->commod,
                   'name' => $val->prices->goods_name->name,
                   'price' => $val->prices->price
                   
                  ];
                 DB::table('orders_details')->sharedLock()->insert($ordeData); 
             }
             return response()->json([
                      'code' => 0,
                      'oid' => $str,
                      'price' => $sum,
                      'name' => '商品名',
                      'ordersID' => $orders

             ],200);
        }else {
            return response()->json([
                 'code' => 1,
                 'msg' => '服务器错误'
            ],500);
        }

    }

    //支付
    public function payment(Request $request) 
    {  
        $uid = session()->get('UserInfo')['id'];
        $order = DB::table('orders')->where($request->input())->where('uid', $uid)->first();  
        dump($order);
        return view('/Home/payment', ['order' => $order]);
    } 

    public function aaa() 
    {
       
        require_once base_path("/app/Libs/alipay/config.php");
        

        $orders = DB::table('orders')->where('id', $_GET['id'])->first();
        
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($orders->orders);

        //订单名称，必填
        $subject = trim($orders->username);

        //付款金额，必填
        $total_amount = trim($orders->total_price);

        //商品描述，可空
        $body = '';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);

    }

    // 同步
    public function synch()
    {
        require_once base_path("/app/Libs/alipay/config.php");
        require_once base_path('/app/Libs/alipay/pagepay/service/AlipayTradeService.php');


        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config); 
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        var_dump($_GET);
       if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);
            $uid = session()->get('UserInfo')['id'];
            $orders = DB::table('orders')->where('uid', $uid)->where('orders', $out_trade_no);
            $ord = $orders->first();
            if($ord->status == '0') {
            $orders->update(['status' => '1']);   
            $details = DB::table('orders_details')->where('oid', $ord->id)->get();
            foreach ($details as $value) {    
            //减库存
                   DB::table('spec_goods_prices')->where('id', $value->sid)->decrement('store_count', $value->num);
                //加销量
                  DB::table('goods')->where('id', $value->gid)->increment('sales', $value->num);
            
           
            }

            //添加销量
            
            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);
                
            echo "验证成功<br />支付宝交易号：".$trade_no;

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            }
            return redirect()->action('Home\UserController@orderDetail');
       
           
        }else {
            //验证失败
            return redirect()->action('Home\UserController@orderDetail');
       
            echo "验证失败";
        }
    
   }
  
    //异步
    public function asynch() 
    {
        
        require_once base_path("/app/Libs/alipay/config.php");
        require_once base_path('/app/Libs/alipay/pagepay/service/AlipayTradeService.php');
        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config); 
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
       if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];
            
            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序
                    $uid = session()->get('UserInfo')['id'];
                    $orders = DB::table('orders')->where('uid', $uid)->where('orders', $out_trade_no);
                    $ord = $orders->first();
                    if($ord->status == '0') {
                    $orders->update(['status' => '1']);
                     //减库存
                        $details = DB::table('orders_details')->where('oid', $ord->id)->get();
                        foreach ($details as $value) {    
                          DB::table('spec_goods_prices')->where('id', $value->sid)->decrement('store_count', $value->num);
                          DB::table('goods')->where('id', $value->gid)->increment('sales', $value->num);
                                
                        }  

                    //注意：
                    //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
                    }

            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序            
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
                //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                echo "success"; //请不要修改或删除
            }else {
                //验证失败
                echo "fail";

            }
                }
}
