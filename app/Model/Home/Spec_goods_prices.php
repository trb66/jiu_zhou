<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Spec_goods_prices extends Model
{
    public function item_ku($id)
    {
    	return $this->where('goods_id',$id)->sum('store_count');
    }

 
}
