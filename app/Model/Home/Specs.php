<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
   public  function item_spec($cid)
   {
     return $this->where('type_id',$cid)->get();
 
   }
   public function specs_Items_Info()
    {
        return $this->hasMany('App\Model\Home\Spec_items', 'spec_id', 'id');
    }

}
