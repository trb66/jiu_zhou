<?php

namespace App\Model\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Blogrolls extends Model
{
    public function add($request)
    {
        $data = [
            'name' => $request->all()['name'],
            'url' => $request->all()['url'],
            'status' => $request->all()['status']
        ];
        return $this->insert($data);
    }
    //分页列表
    public function select()
    {
        return $this->paginate(7);
    }
    //删除友链
    public function del($id)
    {
        return $this->where('id','=',$id)->delete();
    }
    //修改友链状态
    public function status($request)
    {
        return $this->find($request->id);
    }
    //显示编辑友链信息
    public function show($id)
    {
        return $this->where('id','=',$id)->first()->toArray();
    }
    //编辑友链数据
    public function reset($request)
    {
        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'status' => $request->status
        ];
        return $this->where('id','=',$request->id)->update($data);
    }
}