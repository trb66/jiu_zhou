<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    //插入数据
    public function addSub($spe)
    { 
       $this->insert($spe);
       return $spec_id = $this->where($spe)->first()->toArray(); 
    }
}
