<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\trb\Permissions;
use Illuminate\Support\Facades\DB;

class PowerController extends Controller
{
    // 权限列表
    public function index(Request $request)
    {
        $data  = Permissions::paginate(4);// 查出权限

        $str = $request->input('str'); // 模糊搜索

        // 只搜索名字
        if ($str != null) {
            $data = Permissions::where('name', 'like', '%'.$str.'%')
                        ->paginate(4)
                        ->appends(['str' => $str]);
        }

        foreach($data as $k => $v) { // 将控制器名字简化
            $data[$k]['controller'] = str_replace("Controller", "", $v['controller']);
        }

        return view('Admin/power.index', ['pers' => $data]);
    }

    // 添加权限
    public function addpower()
    {
        return view('Admin/power.addpower');
    }

    // 处理添加权限
    public function caddpower(Request $request)
    {
        // 1. 表单验证
        // exists 确定数据表中是否存在数据, 不存在则报错
        $this->validate($request, [
            'name' => [
                'required',  
                'regex:/^[\x{4E00}-\x{9FA5}]{2,14}$/u',
                'unique:permissions',
            ],
            'controller' => [
                'required',
                'regex:/^[A-Za-z]+$/',

            ],
            'action' => [
                'required',
                'regex:/^[A-Za-z]+$/',
            ],
            'descr' => [
                'required',
                'regex:/^[\x{4E00}-\x{9FA5}]{4,20}$/u',
            ],
        ], [
            'required' => ':attribute 不能留空',
            'name.regex' => '权限名称只能由2-14位的中文组成',
            'name.unique' => '权限名称已存在',
            'descr.regex' => '描述只能由2-20位的中文组成',
            'action.regex' => '操作方法名只能由英文组成',
            'controller.regex' => '控制名只能由英文组成',
        ], [
            'name' => '权限名称',
            'controller' => '控制器',
            'action' => '操作方法',
            'descr' => '描述',
        ]);
        $data = [
            'name' => $request->input('name'),
            'controller' => $request->input('controller').'Controller',
            'action' => $request->input('action'),
            'descr' => $request->input('descr'),
        ];

        $pers = new Permissions;

        $res = $pers->add($data);
        if ($res) { // 添加成功
            return [
                'code' => 1,
                'msg' => '添加成功',
            ];
        } else { // 添加失败
            return response()->json([
                'code' => 0,
                'msg' => '服务器错误，请重试~',
            ], 500);
        }
    }

    // 删除权限
    public function delone(Request $request)
    {
        $id = $request->input('id'); // 要删除的权限id

        $res = Permissions::destroy($id);
        if ($res) {
            return [
                'code' => 1, // 代表删除成功
                'msg' => '删除成功',
            ];
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '服务器错误，请重试~',
            ], 500);
        }
    }

    // 修改
    public function edit(Request $request)
    {
        $id = $request->input('id'); // 获取修改权限的ID

        $per = Permissions::where('id', $id)->first()->toArray(); // 查询权限信息

        $per['controller'] = str_replace("Controller", "", $per['controller']);

        return view('Admin/power.edit', ['per' => $per]);
    }

    // 处理修改
    public function cedit(Request $request)
    {
        // 1. 表单验证
        // exists 确定数据表中是否存在数据, 不存在则报错
        $this->validate($request, [
            'name' => [
                'required',  
                'regex:/^[\x{4E00}-\x{9FA5}]{2,14}$/u',
            ],
            'controller' => [
                'required',
                'regex:/^[A-Za-z]+$/',
            ],
            'action' => [
                'required',
                'regex:/^[A-Za-z]+$/',
            ],
            'descr' => [
                'required',
                'regex:/^[\x{4E00}-\x{9FA5}]{4,20}$/u',
            ],
        ], [
            'required' => ':attribute 不能留空',
            'name.regex' => '权限名称只能由2-14位的中文组成',
            'descr.regex' => '描述只能由2-20位的中文组成',
            'action.regex' => '操作方法名只能由英文组成',
            'controller.regex' => '控制名只能由英文组成',
        ], [
            'name' => '权限名称',
            'controller' => '控制器',
            'action' => '操作方法',
            'descr' => '描述',
        ]);

        $id = $request->input('id'); // ID

        $res = Permissions::where('name', $request->input('name'))
                        ->where('id', '!=', $id)
                        ->first();

        if(!is_null($res)) {
            return response()->json([
                'code' => 0,
                'msg' => '权限名已存在',
            ], 500);
        }

        $data = [
            'name' => $request->input('name'), // 权限名
            'controller' => $request->input('controller').'Controller', // 控制器名
            'action' => $request->input('action'), // 操作方法名
            'descr' => $request->input('descr'), // 操作方法名
        ];
        $upds = Permissions::where('id', $id)
                    ->update($data);
        if ($upds) { // 修改成功
            return [
                'code' => 1,
                'msg' => '修改成功',
            ];
        } else { // 修改失败
            return response()->json([
                'code' => 0,
                'msg' => '服务器繁忙，请重试~',
            ], 500);
        }
    }
}