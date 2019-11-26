<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Home\Goods;
use App\Model\Home\Imgs;
use App\Model\Home\Types;
use App\Model\Home\Specs;
use App\Model\Home\Comments;
use App\Model\Home\Users;
use App\Model\Home\Users_infos;
use App\Model\Home\Spec_goods_prices;
use App\Model\Home\Order_details;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Item_showController extends Controller
{
  
    public function show(Request $request) 
    {    
        //接收传过来的id
        $id = $request->input('id');

        $res = new Goods();
        $res_img = new Imgs();
        $res_type = new Types();
        $res_user = new Users();
        $res_comment = new Comments();
        $res_spec = new Specs(); 
        $res_spec_goods_price = new Spec_goods_prices(); 
       
        //查出这个商品的所以信息
        $goods = $res->item_show($id);
  
        $img_id = $goods['id'];
        $cid = $goods['cid'];

         //得到这个商品所属的分类
        $type = $res_type->item_type($cid);
        

        $typeid = $type['id'];

        
        //查规格
        $spec = $res_spec->item_spec($cid);
       
        foreach ($spec as $k => $v) {

            $spec_item = DB::table('spec_items')->where('spec_id',$v->id)->get();

            $spec_item_new = []; 

            foreach ($spec_item as $key => $value) {
                $spec_item_new[] = $value->time;
            }
            $v->time = $spec_item_new;
        }
        // dump($spec);
        //查库存
         $store_count = $res_spec_goods_price->item_ku($id); 
         
       
        //查出爆款的商品
        $baokuan = $res->item_baokuan($typeid,$id);
        $goodid = [];
        foreach ($baokuan as $k => $v) {
            $goodid[$k] = $v->id;
        }
        //爆款的图片
        $imgs = $res_img->item_img($img_id);
        
        // $baoimg = $ress
        //接收商品预览图片
        $preview_img = $imgs[0];
        //接收商品介绍图片
        $introduce_img = $imgs[1];
        
        //查出这个商品的评论

        $comment = $res_comment->item_comment($id);

        $comments = $comment[0];

        $count = $comment[1];
        return view('Home.item_show',[
                           'good'=> $goods,
                           'type'=>$type,
                           'pre'=>$preview_img,
                           'introduce'=>$introduce_img,
                           'baokuan'=> $baokuan,
                           'comments'=>$comments,
                           'count'=>$count,
                           'spec'=> $spec,
                           'ku' => $store_count,
                     
        ]);
    }
    public function spec_all(Request $request) 
    {
      $names = $request->input('names');
     
      $good = DB::table('spec_goods_prices')->where('key_name',$names)->first();
      $ku = $good->store_count;
      return ['good' =>$good,'ku'=>$ku];
    }  
  
    
    // 加入购物车
    public function addcar(Request $request)
    {  
        if (session('UserInfo') != null) {
            
            $uid = session('UserInfo.id');
            $commod = $request->input('commod');
            $key_name = $request->input('names');

            if ($key_name != '' ) {

	            $good = DB::table('spec_goods_prices')->where('key_name',$key_name)->first();   

	            $data = [
	                  'uid' => $uid,
	                  'spec_id' =>$good->id,
	                  'commod' => $commod,
	                  'selected'=> '0',
	                 ];
	            $addcar = DB::table('shop_cars')->insert($data);
	            
	            if ($addcar) {
	              return response()->json([
	                'code' => 0,
	                'msg' => '已成功加入购物车，是否进入购物车',
	            ],200);
	            }
	              return response()->json([
	                'code' => 1,
	                'msg' => '网络繁忙加入购物车失败，请检查网络是否通畅',
	            ],200); 

            } 
             return response()->json([
	                'code' => 2,
	                'msg' => '请选择规格',
	            ],200); 


        } else {
           return response()->json([
                'code' => 1,
                'msg' => '请登录',
            ], 500);
         
        }
        
    }

   //收藏
   public function item_collect(Request $request)
   { 
   	       
      if (session('UserInfo') != null) {

    	$gid = $request->input('gid');
        $uid = session('UserInfo.id');
        
        //查询该商品是否已收藏
        $arcollect = DB::table('collects')->where('uid',$uid)->where('goods_id',$gid)->first();
     
        if ($arcollect) {
           return response()->json([
	                'code' => 2,
	                'msg' => '您已收藏过这个商品啦',
	        ],200);
        } else {

	        $data = [
	           'uid' => $uid,  
	           'goods_id' => $gid,
	        ];

	        $collect = DB::table('collects')->insert($data);

	         if ($collect) {
	            return response()->json([
		                'code' => 0,
		                'msg' => '收藏成功',
		            ],200);
	         }
	          return response()->json([
		                'code' => 1,
		                'msg' => '网络繁忙，请检查网络是否通畅再重试',
		            ],200);
        }

      } else {
           return response()->json([
                'code' => 1,
                'msg' => '请登录',
            ], 500);
         
      }
     
   }
   //立即购买
   public function item_gobuy(Request $request) 
   {
      if (session('UserInfo') != null) {
            
            $uid = session('UserInfo.id');
            $commod = $request->input('commod');
            $key_name = $request->input('names');

            if ($key_name != '' ) {

	            $good = DB::table('spec_goods_prices')->where('key_name',$key_name)->first();   

	            $data = [
	                  'uid' => $uid,
	                  'spec_id' =>$good->id,
	                  'commod' => $commod,
	                  'selected'=> '1',
	                 ];
	            $addcar = DB::table('shop_cars')->insert($data);
	            
	            if ($addcar) {
	              return response()->json([
	                'code' => 0,
	                'msg' => '正在努力跳转...........',
	            ],200);
	            }
	              return response()->json([
	                'code' => 1,
	                'msg' => '网络繁忙，请检查网络是否通畅',
	            ],200); 

            } 
             return response()->json([
	                'code' => 2,
	                'msg' => '请选择规格',
	            ],200); 


        } else {
           return response()->json([
                'code' => 1,
                'msg' => '请登录',
            ], 500);
         
        }
 

   }


}
