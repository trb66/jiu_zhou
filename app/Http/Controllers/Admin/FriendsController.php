<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Blogrolls;

class FriendsController extends Controller
{
    public function index()
    {
        $model = new Blogrolls();
        $res = $model->select();
        $arr = [1 => '显示',2 => '禁用'];
        return view('Admin/friend/list',[
            'list' => $res,
            'arr' => $arr
        ]);
    }

    //显示添加页面
    public function doadd()
    {
        return view('Admin/friend/add');
    }

    //添加友链
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'url' => ['required','regex:/[a-zA-Z0-9][-a-zA-Z0-9](\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})(\.[a-zA-Z0-9])+\.?/']
        ],[
            'name.required' => '友链名不能为空',
            'url.required' => '友链地址不能为空',
            'url.regex' => '友链地址格式不正确'
        ]);

        $model = new Blogrolls();
        if($model->add($request)){
            return [
                'code' => 0,
                'msg' => '添加成功',
                'url' => '/admin/friend'
            ];
        }else{
            return response()->json([
                'code' => 1,
                'msg' => '添加失败',
            ],500);
        }
    }

    //删除友链
    public function del(Request $request)
    {
        $model = new Blogrolls;
        $res = $model->del($request->id);
        if($res){
            return [
                'code' => 0,
                'msg' => '删除成功',
                'url' => '/admin/friend'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '删除失败',
            ];
        }
    }

    //修改状态
    public function statuse(Request $request)
    {
        $model = new Blogrolls;
        $res = $model->status($request);
        if ($res->status == '1') {
            $res->status = '2';
            $res->save();
            return [
                'code' => 0,
                'msg' => '修改成功'
            ];
        } elseif ($res->status == '2') {
            $res->status = '1';
            $res->save();
            return [
                'code' => 0,
                'msg' => '修改成功'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '修改失败'
            ];
        }
    }

    //显示编辑页面
    public function edit($id)
    {
        $model = new Blogrolls;
        $res = $model->show($id);
        return view('Admin/friend/edit',[
            'arr' => $res
        ]);
    }
    //编辑友链
    public function save(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'url' => ['required','regex:/[a-zA-Z0-9][-a-zA-Z0-9](\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})(\.[a-zA-Z0-9])+\.?/']
        ],[
            'name.required' => '友链名不能为空',
            'url.required' => '友链地址不能为空',
            'url.regex' => '友链地址必须是以www.开头'
        ]);

        $model = new Blogrolls;
        $res = $model->reset($request);
        if($res){
            return [
                'code' => 0,
                'msg' => '修改成功',
                'url' => '/admin/friend'
            ];
        }else{
            return response()->json([
                'code' => 1,
                'msg' => '修改失败',
            ],500);
        }
    }
}