<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Shop_cars extends Model
{
    //查找购物车里面的数据
    public function seek($uid)
    {
       return $cars = $this->where('uid', $uid)->get();

       // dump($cars);

    }
    
    //规格详情表spec_goods_prices等于cars表spec_id的详细信息
    // public function prices()
    // {
    //     return $this->hasOne('App\Model\Admin\Spec_goods_prices', 'id', 'spec_id');
    // }
    //商品详情
    // public function goods($goods_id)
    // {
    //     return $goods = DB::table('goods')->where('id', $goods_id)->get();
    //      // dump($goods_id);
    // }

    // public function imgs($imgs_id)
    // {
    //     return $imgs = DB::table('imgs')->where('goods_id', $imgs_id)->get();
    // }
    
}
