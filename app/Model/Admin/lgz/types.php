<?php

namespace App\Model\Admin\lgz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class types extends Model
{
    //查出types分类表全部内容
    public function types() {
        return types::get();
    }

    //通过得到的ID删除分类
    public function del($id) {
        $typeDel = $this->where('id',$id)
                   ->delete();
        if($typeDel) {
            return '0';
        } else {
            return '1';
        }
        
    }
}
