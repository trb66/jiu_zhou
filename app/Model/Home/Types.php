<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class types extends Model
{
   public function item_type($cid)
   {
        $type = $this->where('id',$cid)->first();

        $typetow = $this->where('id',$type->pid)->first();


        return [$type,$typetow];
   }
}
