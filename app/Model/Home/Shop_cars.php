<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Shop_cars extends Model
{
    //查找购物车里面的数据
    public function seek($uid)
    {

       return $cars = $this->where('uid', $uid)->where('selected', 0)->get();

       // dump($cars);

    }


    //查询订单状态为1的数据
    public function carsOne($uid)
    {   

        return $cars = $this->where('uid', $uid)->where('selected', 1)->get();

    }
    //规格详情表spec_goods_prices等于cars表spec_id的详细信息
    public function prices()
    {
        return $this->hasOne('App\Model\Admin\Spec_goods_prices', 'id', 'spec_id');
    }
    
}
