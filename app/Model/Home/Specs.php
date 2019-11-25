<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
   public  function item_spec($cid)
   {
     return $this->where('type_id',$cid)->get();
 
   }
   
}
