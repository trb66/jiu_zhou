<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Goods extends Model
{
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
}