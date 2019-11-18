<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Imgs extends Model
{
    //查出商品图片
    public function imgs($goods_id)
    {
        
        // $goods_id = $good->id;
        // dump($good);
        return $imgs = $this->where('goods_id', $goods_id)->get()->toArray();       

    }
    //上传商品图片
    public function addSub($data)
    {
        return $win = $this->insert($data);

    }
}
