<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Goods extends Model
{
    //插入商品数据
    public function addSub($data)
    {
     //把商品数据插入数据库
      $this->insert($data);  
    }

    //遍历数据
    public function goods($page=5) 
    {
       
      $goods = $this->get();

      foreach($goods as $good){
      }
      //分组排序
      return $this->orderBy('cid', 'asc')->paginate($page);
      //      Types:: 
      // return $this->orderBy(DB::raw('concat(cid,id)'))->paginate($page);

    }

    public function tname()
    {   
        //查Types分类表里面id = 商品表里cid 的数据
        return $this->hasOne('App\Model\Admin\Types', 'id', 'cid');
    }

    //更新编辑数据
    public function editSub($data)
    {   
        // dump($data['id']);
        return $this->where('id', $data['id'])->update($data);
    }

    //删除数据
    public function del($id)
    {
        
        return $delUser = $this->where('id', $id)->delete();
    }

    
}
