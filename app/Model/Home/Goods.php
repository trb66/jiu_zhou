<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

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

}
