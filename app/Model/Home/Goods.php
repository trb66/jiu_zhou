<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
   public function item_show($id)
   {
      return $this->where('id',$id)->first();
   }

   public function item_baokuan ($typeid,$id) 
   {
     return $this->where('cid',$typeid)->where('id','!=',$id)->limit(6,12)->get();

   }

   public function baokuan_img()
   {
   	return $this->hasOne('App\Model\Home\Imgs','goods_id','id');
   }


    public function sel($id)
    {
        $res = $this->where('cid','=',$id)->where('status','=',0)->paginate(8);
        if ($res->first()) {
            foreach ($res as $k => $v) {
                $img = DB::table('imgs')->where('goods_id','=',$v['id'])->first();
                
                $img_path = $img->pic;
              
                $res[$k]['pic'] = $img_path;
            }
        }else{
            echo '<script>alert("亲,抱歉暂无数据呢~");location.href="/"</script>';
        }
        return $res;
    }
    //goods_list的搜索
    public function search($name)
    {
        $res = $this->where('name','like','%'. $name .'%')->where('status','=',0)->paginate(8);

        if($res->first()){
            foreach ($res as $k => $v) {
                $img = DB::table('imgs')->where('goods_id','=',$v->id)->get();
                
                foreach ($img as $val) {
                    $img_path = $val->pic;
                }
                $v->pic = $img_path;
            }
            return $res;
        }else{
            $res = $this->where('status','=',0)->paginate(8);
            foreach ($res as $k => $v) {
                $img = DB::table('imgs')->where('goods_id','=',$v->id)->get();
                
                foreach ($img as $val) {
                    $img_path = $val->pic;
                }
                $v->pic = $img_path;
            }
            return $res;
        }
    }

    //规格
    public function Spec_goods_prices()
    {
       return $this->hasOne('App\Model\Home\Spec_goods_prices','goods_id', 'id');
    }

    //销量降序
    public function orders($id)
    {
        $res = $this->where('cid','=',$id)
                    ->where('status','=',0)
                    ->orderBy('sales','desc')
                    ->paginate(8);
        foreach ($res as $k => $v) {
            $img = DB::table('imgs')->where('goods_id','=',$v['id'])->first();
            
            $img_path = $img->pic;
          
            $res[$k]['pic'] = $img_path;
        }
        return $res;
    }
    //价格排序
    public function price($id)
    {
        $res = $this->where('cid','=',$id)
                    ->where('status','=',0)
                    ->orderBy('price')
                    ->paginate(8);
        foreach ($res as $k => $v) {
            $img = DB::table('imgs')->where('goods_id','=',$v['id'])->first();
            
            $img_path = $img->pic;
          
            $res[$k]['pic'] = $img_path;
        }
        return $res;
    }

    public function group($id)
    {
        $res = $this->where('cid','=',$id)
                    ->where('status','=',0)
                    ->whereBetween('price',$_GET)
                    ->paginate(8);
        foreach ($res as $k => $v) {
            $img = DB::table('imgs')->where('goods_id','=',$v['id'])->first();
            
            $img_path = $img->pic;
          
            $res[$k]['pic'] = $img_path;
        }
        return $res;
    }
}