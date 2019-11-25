<?php

namespace App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders_details extends Model
{
    public function imgs()
    {

    }

    public function specification()
    {
      return $this->hasOne('App\Model\Admin\Spec_goods_prices', 'id', 'sid');    
    }

    public function goodsImg()
    {
        return $this->hasOne('App\Model\Admin\Imgs', 'goods_id', 'gid');    
    }
}    

