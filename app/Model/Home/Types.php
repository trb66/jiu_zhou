<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Types extends Model
{
    //一级分类数据
    public function select()
    {
        return $this->where('pid','=',0)->limit(5)->get()->toArray();
    }
    //查2级分类
    public function zi()
    {
        $list = $this->where('pid','=',0)->get()->toArray();
        foreach ($list as $k => $v) {
            // dump($v['id']);
            if(array_key_exists($v['id'], $list)){
                $son = $this->where('pid','=',$v['id'])->get()->toArray();
                dump($son);
            }
        }
        // dump($son);
        return $son;
    }
}
