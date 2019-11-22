<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Spec_goods_prices extends Model
{
    //插入数据
    public function specGoodPrice($sgp)
    { 
          $speGP = $this->insert($sgp);
          if($speGP)
          {
            return true;
          } else {
            return false;
          }
          // dump($speGP);
    }
    
    //查出所有规格数据
    public function Sgpsel($pag = 15)
    {
        return $this->paginate($pag);
    }
    
    //查goods表里面同goods_id的数据
    public function goods_name()
    {
        return $this->hasOne('App\Model\Admin\Goods', 'id', 'goods_id');
    }
}
