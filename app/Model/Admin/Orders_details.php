<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Orders_details extends Model
{
    public function order_look($id)
    {
       return $this->where('oid',$id)->get();

    }

    public function order_img()
    {
        return $this->hasOne('\App\Model\Admin\Imgs', 'goods_id', 'gid');
        
    }

    public function order_spec()
    {

    	return $this->hasOne('\App\Model\Admin\Spec_goods_prices','id','sid');
    }

}
