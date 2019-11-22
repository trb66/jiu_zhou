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
use App\Model\Home\Spec_goods_prices;

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
        $typeall = $res_type->item_type($cid);
        
        $type = $typeall[0];
        //二级分类
        $typetow = $typeall[1];

        $typeid = $type->id;
        //查规格
        $spec = $res_spec->item_spec($cid);
        // dump($spec);
       
        foreach ($spec as $k => $v) {
    
            // dump($v);
            $spec_item = DB::table('spec_items')->where('spec_id',$v->id)->get();

            $spec_item_new = []; 

            foreach ($spec_item as $key => $value) {
                // dump($value);
                $spec_item_new[] = $value->time;
            }
            $v->time = $spec_item_new;
        }
        // dump($spec);
        //查库存
         $store_count = $res_spec_goods_price->item_ku($id); 


        //查出爆款的商品
        $baokuan = $res->item_baokuan($typeid,$id);
        // dump($baokuan);
        $goodid = [];
        foreach ($baokuan as $k => $v) {
            $goodid[$k] = $v->id;
        }
        // dump($goodid);
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

}
