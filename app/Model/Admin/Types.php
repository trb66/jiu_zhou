<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Types extends Model
{
    //查出types分类表全部内容
    public function types($page=10) {
        
        return $this->orderBy(DB::raw('concat(path,id)'))
                    ->paginate($page);
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

    //通过得到的id查出数据
    public function red($id) {


    }

    //编辑的数据
    public function edit($p) {  
        $data = [
             'name' => $_POST['name'],
             // 'updated_at' => date('Y:m:d H:i:s') 
         ];
         //将name字段更新
         $this->where('id','=', $_POST['id'])
              ->update($data);
    }

    //插入子集分类
    public function addSub() {
        $data = [
              'name' => $_POST['name'],
              'pid' => $_POST['id'],
              'path' => $_POST['path'].$_POST['id'].',', 
        ];
        $this->insert($data);
        
    }

     
}
