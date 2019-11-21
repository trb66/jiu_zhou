<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Types extends Model
{
    //查分类数据
    public function select()
    {
        //一级分类
        $list = $this->where('pid','=',0)->get()->toArray();
        foreach ($list as $k => $v) {
            //二级分类
            $son = $this->where('pid','=',$v['id'])->get()->toArray();
            if(!empty($son)){
                $list[$k]['son'] = $son;
            }
            foreach ($list[$k]['son'] as $key => $val) {
                //三级分类
                $sun = $this->where('pid','=',$val['id'])->get()->toArray();
                if (!empty($sun)) {
                    $list[$k]['son'][$key]['sun'] = $sun;
                }
                //遍历三级分类里的数据
                foreach ($list[$k]['son'][$key]['sun'] as $kkk => $value) {
                    //查goods表的cid等于三级分类数据里的id
                    $goodsinfo = DB::table('goods')->where('cid','=',$value['id'])->where('status','=',0)->limit(6)->get();
                    if (!empty($goodsinfo)) {
                        //遍历三级商品的数据
                        foreach ($goodsinfo as $g) {
                            //查出商品里的图片数据
                            $img_path = DB::table('imgs')->where('goods_id','=',$g->id)->first();
                            //把图片地址给赋值到分类数据里
                            $g->pic = $img_path->pic;
                            
                            $list[$k]['goodtype'][] = $g;
                        }
                    }
                }
            }
        }
        return $list;
    }

    //首页的搜索
    public function search($name)
    {
        $res = DB::table('goods')->where('name','like','%'. $name .'%')->paginate(8);
        if(!empty($res)){
            foreach ($res as $k => $v) {
                $img = DB::table('imgs')->where('goods_id','=',$v->id)->get();
                
                foreach ($img as $val) {
                    $img_path = $val->pic;
                }
                $v->pic = $img_path;
            }
        }
        return $res;
    }
}