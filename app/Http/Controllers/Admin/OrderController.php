<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Orders;
use App\Model\Admin\Addrs;
use App\Model\Admin\Goods;
use App\Model\Admin\Users_infos;
use App\Model\Admin\Orders_details;
use App\Model\Admin\Users;
use App\Model\Admin\Expresses;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    
   public function index(Request $request) 
   { 
         
        $sta = $request->input('status');
        $text = $request->input('text');

        $request->session()->flash('status', $sta);
        $request->session()->flash('text', $text);

        $res = new Orders();

        $order = $res->show($sta,$text);
        
        // dump($order);

        $status = [ 0 => "未支付",1 => '待发货',2 =>'待收货', 3 =>'已完成',4 =>'用户已删除'];
        return view('Admin/order.order',['orders' => $order,'status'=>$status]);
    
   }

   //删除订单
   public function del(Request $request)
   {

       $id = $request->input('id');

       $res = new Orders();
       $del = $res->del($id);

        if ($del) {
          return [
            'code' => 0,
            'msg' => '订单已删除'
        ];
       } else {
         return response()->json([
            'code' => 1,
            'msg' => '订单删除失败'

         ],500);
       }
    } 
      
    //发货
    public function fahuo(Request $request)
    { 

      $id = $request->input('id');
      $log = $request->input('log');
      $lognum = $request->input('lognum');
    	

       $data = [
       	 'oid'=> $id,
         'express_name' => $log,
         'express' => $lognum,
       ];


      $wuliu = DB::table('expresses')->insert($data);
      
      if ($wuliu) {

        $status = ['status' => '2'];

        $fahuo = DB::table('orders')->where('id','=',$id)->update($status);

         if ($fahuo) {
            return response()->json([
              'code' => 0,
              'msg' => '已成功发货'
          ],200);
         } else {
           return response()->json([
              'code' => 1,
              'msg' => '网络错误，发货失败'

           ],500);
         }

      }  
  }
     
   public function alter(Request $request)
   {
     
    $id = $request->input('id');
    
    // dump($id);
    $res = new Orders();
    
    $order = $res->alter($id);

    $status = [ 0 => "未支付",1 => "已支付", 2 => '待发货',3 =>'待收货', 4 =>'已完成'];

    $addr = explode('-', $order->address);

    $order->addr1 = $addr[0];
    $order->addr2 = $addr[1];
    $order->addr3 = $addr[2];
    $order->addr4 = $addr[3];
    return view('Admin/order.reorder',['order'=>$order,'status'=>$status]);


  }
   public function edit(Request $request)
   {   
     $id = $request->input('id');
      
    $data = [
       'phone'=> $request->input('phone'),
       'address' => $request->input('address'), 
    ] ;
   
     $res = new Orders();
     $edit = $res->order_edit($id,$data);

     dump($edit);
       if ($edit) {
          return response()->json([
            'code' => 0,
            'msg' => '修改成功',
        ],200);
       } else {
         return response()->json([
            'code' => 1,
            'msg' => '服务器繁忙，修改失败'

         ],500);
       }
  }

   public function look(Request $request)
   {  

    $id = $request->input('id');

    $res = new Orders();
    
    $order = $res->alter($id);



    $res_detail = new Orders_details();

    $detail = $res_detail->order_look($id);

    $status = [ 0 => "未支付",1 => "已支付", 2 => '待发货',3 =>'待收货', 4 =>'已完成'];
    

    return view('Admin/order.lookorder',['order'=>$order,'status'=>$status,'detail'=>$detail]);
   } 


   public function print(Request $request)
   {

    $id = $request->input('id');

    $res = new Orders();
    
    $order = $res->alter($id);

    $res_detail = new Orders_details();

    $detail = $res_detail->order_look($id);
    
    return view('Admin/order.print',['order'=>$order,'detail'=>$detail]);




   }

}


