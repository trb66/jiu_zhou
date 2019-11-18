<?php

namespace App\Model\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Slideshows extends Model
{
    //添加轮播图
    public function add($request)
    {
        $data = [];
        //遍历从那边ajax传过来的所有数据
        foreach ($request->pic as $v) {
            $data[] = [
                'name' => $request->name,
                'status' => $request->status,
                'pic' => $v->store('lunbo','public'),
            ];
        }
        return $this->insert($data);
    }
    //分页显示轮播列表
    public function show()
    {
        return $this->paginate(4);
    }

    //显示修改轮播图
    public function edit($id)
    {
        return $this->where('id','=',$id)->first()->toArray();
    }
    //修改轮播图
    public function reset($request)
    {
        $id = $request->id;
        $obj = $this->where('id','=',$id)->first();
        $url ='/www/wwwroot/jiu_zhou/storage/app/public/'.$obj->pic;
        unlink($url);
        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'pic' => $request->pic->store('lunbo','public')
        ];
        return $this->where('id','=',$id)->update($data);
    }

    //轮播搜索
    public function search()
    {
        $name = $_POST['name'];
        return $this->where('name','like','%'.$name.'%')->paginate(4);
    }

    //修改轮播状态
    public function statuse($request)
    {
        return $this->find($request->id);
    }

    //删除轮播
    public function del($id)
    {
        $obj = $this->where('id','=',$id)->first();
        $url ='/www/wwwroot/jiu_zhou/storage/app/public/'.$obj->pic;
        $res = $this->where('id','=',$id)->delete();
        if($res){
            unlink($url);
            return $res;
        }
    }
}