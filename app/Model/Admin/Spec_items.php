<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Spec_items extends Model
{
    //插入属性值
    public function addSub($specs_id,$itmes)
    {
        // dump($itmes);
        
        foreach ($itmes as $value) {
            $this->insert(['spec_id' => $specs_id, 'time' => $value]);
        }
            return true;

    }
}