<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;//M
use App\Model\Admin\Slideshows;

class LunboController extends Controller
{
    public function index()
    {
        $model = new Slideshows();
        $bannerList = $model->show();
        $arr = [1 => '显示', 2 => '禁用'];
        return view('Admin/lunbo/list',[
            'list' => $bannerList,
            'arr' => $arr
        ]);
    }

    //添加轮播图页面
    public function doadd()
    {
        return view('Admin/lunbo/doadd');
    }

    //添加轮播图操作
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'pic' => 'required'
        ],[
            'name.required' => '轮播名不能为空',
            'pic.required' => '图片不能为空'
        ]);

        $model = new Slideshows();
        if($model->add($request)){
            return [
                'code' => 0,
                'msg' => '添加成功',
                'url' => '/admin/lunbo'
            ];
        }else{
            return response()->json([
                'code' => 1,
                'msg' => '添加失败'
            ],500);
        }
    }

    //显示修改轮播图
    public function edit($id)
    {
        $model = new Slideshows();
        $res = $model->edit($id);
        return view('Admin/lunbo/edit',[
            'arr' => $res
        ]);
    }
    //修改轮播信息
    public function save(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'pic' => 'required'
        ],[
            'name.required' => '轮播名不能为空',
            'pic.required' => '图片不能为空'
        ]);

        $model = new Slideshows();
        if($model->reset($request)){
            return [
                'code' => 0,
                'msg' => '修改成功',
                'url' => '/admin/lunbo'
            ];
        }else{
            return response()->json([
                'code' => 1,
                'msg' => '修改失败'
            ],500);
        }
    }

    //删除轮播信息
    public function del(Request $request)
    {
        $model = new Slideshows;
        $res = $model->del($request->id);
        if($res){
            return [
                'code' => 0,
                'msg' => '删除成功',
                'url' => '/admin/lunbo'
            ];
        }
    }
    //显示搜索页面
    public function search()
    {
        $model = new Slideshows();
        $res = $model->search();
        $arr = [1 => '显示', 2 => '禁用'];
        return view('Admin/lunbo/list',[
            'list' => $res,
            'arr' => $arr
        ]);
    }
    //修改轮播的状态
    public function statuse(Request $request)
    {
        $model = new Slideshows;
        $res = $model->statuse($request);
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
}