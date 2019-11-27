<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Orders_details extends Model
{
       public function item_gui()
    {
      return $this->hasOne('App\Model\Home\Spec_goods_prices','id','sid');
    }
}
