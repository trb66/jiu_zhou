<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\trb\Roles;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\trb\Admin;
use App\Model\Admin\trb\User_has_roles;

class AdminController extends Controller
{
    // 后台会员列表
    public function index(Request $request)
    {
        $data = Admin::paginate(4);
        return view('Admin/houtai.list', ['data' => $data]); // 分配数据
    }
      
    // 搜索
    public function sel(Request $request)
    {
        $status = $request->input('status'); // 状态
        $name = $request->input('name'); // 搜索值
        $data = [];

        if ($status != '状态' && $name == null) {
            $data = Admin::where('status', $status)->paginate(4);
            $request->session()->flash('status', $status);
        }

        if ($status == '状态' && $name != null) {
            $data = Admin::where('name', 'like', $name)->paginate(4);
            $request->session()->flash('name', $name);
        }

        if ($status != '状态' && $name != null) {
            $data = Admin::where('name', 'like', $name)->where('status', $status)->paginate(4);
            $request->session()->flash('status', $status);
            $request->session()->flash('name', $name);
        }

        return view('Admin/houtai.list', ['data' => $data]); // 分配数据   
    }

    // 添加后台用户
    public function add()
    {
        $data = Roles::get(); // 查询出所有的角色
        return view('Admin/houtai.add', ['data' => $data]);
    }

    // 处理添加后台用户
    public function cadd(Request $request)
    {
        // 1. 表单验证
        // exists 确定数据表中是否存在数据, 不存在则报错
        $this->validate($request, [
            'name' => [
                'required',  
                'regex:/^[a-zA-Z0-9]{3,16}$/',
                'unique:admins',
            ],
            'pwd' => [
                'required',
                'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/',
            ],
            'pwd2' => [
                'required',
                'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/',
                "same:pwd",
            ],
            'email' => 'required|email',

            'phone' => [
                'required',
                'regex:/^1[3456789]\d{9}$/',
            ],
        ], [
            'required' => ':attribute 不能留空',
            'email' => '邮箱格式不正确',
            'phone.regex' => '手机号格式不正确',
            'name.regex' => '用户名只能由3-12位的字母,数字,下划线组成',
            'name.unique' => '用户名已经存在',
            'pwd.regex' => '密码最少包含数字和英文 长度6-20',
            'pwd2.regex' => '密码最少包含数字和英文 长度6-20',
            'pwd2.same' => '两次密码不一致',
        ], [
            'name' => '用户名',
            'pwd' => '密码',
            'pwd2' => '密码',
            'pwd2' => '密码',
            'email' => '邮箱',
            'phone' => '手机号',
        ]);
        // 2.保存数据
        $data = $request->all(); // 获取所有的用户输入数据

        $adm = new Admin; // 实例化模型类

        $res = $adm->adds($data); // 调用添加数据方法

        if ($res) { // 成功
            return [
                'code'=> 1,
                'msg' => '插入成功',
            ];
        } else { // 失败
            return [
                'code'=> 0,
                'msg' => '插入失败',
            ];
        }

    }

    // 删除后台用户
    public function del(Request $request)
    {
        $id = $request->id;
        // 删除用户
        $adms = new Admin;
        $res = $adms->where('id', $id)->delete();
        if ($res) {
            $ums = new User_has_roles;

            $rols = $ums->where('user_id', $id)->get()->toArray();

            if (!empty($rols)) {
                $ress = $ums->where('user_id', '=', $id)->delete();
                if ($ress) {
                    return [
                        'code' => 1,
                        'msg' => '删除成功',
                    ];
                }
            }
            return [
                'code' => 1,
                'msg' => '删除成功',
            ];
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '删除失败',
            ], 500);
        }
    }

    // 删除多个
    public function delall(Request $request)
    {
        $ids = $request->input('id');

        $dels = new Admin;

        $res = $dels->dellalls($ids);

        if ($res) {
            return [
                'code' => 1,
                'msg' => '删除成功',
            ];
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '删除失败',
            ], 500);
        }
    }


    // 改变状态
    public function status(Request $request)
    {
        $id = $request->get('id');
        // 查出数据
        $res = Admin::find($id);

        // 判断状态
        if ($res->status == 0) {

            $res->status = 1; // 设置值

            $res = $res->save();
            if ($res) {
                return 1; // 修改成功
            } else {
                return 0; // 修改失败
            }
        } else {
            $res->status = 0; // 设置值

            $res = $res->save();

            if ($res) {
                return 1; // 修改成功
            } else {
                return 0; // 修改失败
            }
        }
    }

    // 修改
    public function edit(Request $request)
    {
        $id = $request->get('id');
        
        // 用户信息
        $info = Admin::find($id)->toArray();
        // 用户拥有的角色id
        $rid = User_has_roles::where('user_id', $id)->select('role_id')->get()->toArray();
        $ros = [];
        foreach($rid as $k => $v) {
            $ros[$k] = $v['role_id'];
        }
        $data = Roles::get(); // 查询出所有的角色
        return view('Admin/houtai.edit', ['data' => $data, 'info' => $info, 'ros' => $ros]);
    }

    // 处理修改
    public function cedit(Request $request)
    {
        // 1. 表单验证
        // exists 确定数据表中是否存在数据, 不存在则报错
        $this->validate($request, [
            'name' => [
                'required',  
                'regex:/^[a-zA-Z0-9]{3,16}$/',
            ],
            'pwd' => [
                'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/',
            ],
            'pwd2' => [
                'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/',
                "same:pwd",
            ],
            'email' => 'required|email',

            'phone' => [
                'required',
                'regex:/^1[3456789]\d{9}$/',
            ],
        ], [
            'required' => ':attribute 不能留空',
            'email' => '邮箱格式不正确',
            'phone.regex' => '手机号格式不正确',
            'name.regex' => '用户名只能由3-12位的字母,数字,下划线组成',
            'pwd.regex' => '密码最少包含数字和英文 长度6-20',
            'pwd2.regex' => '密码最少包含数字和英文 长度6-20',
            'pwd2.same' => '两次密码不一致',
        ], [
            'name' => '用户名',
            'pwd' => '密码',
            'pwd2' => '密码',
            'email' => '邮箱',
            'phone' => '手机号',
        ]);

        $name = $request->name; // 用户名
        $id = $request->id; // id

        $res = Admin::where('name', $name)
            ->where('id', '!=', $id)
            ->first();

        if ($res) { // 用户名已经存在情况
            return response()->json([
                'code' => 0,
                'msg' => '用户名已存在',
            ], 500);
        } else { // 通过
            if ($request->pwd == '') { // 不修改密码
                $eds = new Admin; // 实例化模型类
                $data = $request->all();
                $res = $eds->edits($data); // 调用添加数据方法
                if ($res) { // 修改成功
                    return [
                        'code' => 1, // 修改成功
                        'msg' => '修改成功',
                    ];
                } else { // 修改失败
                    return response()->json([
                        'code' => 0,
                        'msg' => '服务器错误，请重试~',
                    ], 500);
                }
            } else { // 修改密码
                $eds = new Admin; // 实例化模型类
                $data = $request->all();
                $res = $eds->editsp($data); // 调用添加数据方法
                if ($res) { // 修改成功
                    return [
                        'code' => 1, // 修改成功
                        'msg' => '修改成功',
                    ];
                } else { // 修改失败
                    return response()->json([
                        'code' => 0,
                        'msg' => '服务器错误，请重试~',
                    ], 500);
                }
            }

        }
    }
}

