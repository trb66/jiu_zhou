<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Imgs extends Model
{
    public function item_img($img_id)
    {
     $preview = $this->where('goods_id',$img_id)
                     ->where('img_type','=','0')
                     ->get();
     $introduce = $this->where('goods_id',$img_id)
                     ->where('img_type','=','1')
                     ->get();
     
     return [$preview,$introduce];
    }

    
}
