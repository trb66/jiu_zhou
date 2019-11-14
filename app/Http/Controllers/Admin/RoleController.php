<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\trb\Roles;
use App\Model\Admin\trb\Permissions;
use App\Model\Admin\trb\Role_has_permissions;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // 角色列表
    public function index(Request $request)
    {
        return '角色列表';
    }

    // 添加角色
    public function addroles(Request $request)
    {
        $pers = Permissions::get()->toArray(); // 查询权限

        return view('Admin/role.addrole', ['pers' => $pers]); // 返回视图，分配数据
    }

    // 处理添加角色
    public function caddroles(Request $request)
    {
        // 1. 表单验证
        $this->validate($request, [
            'name' => [
                'required',
                'unique:roles',
                'regex:/^[\x{4E00}-\x{9FA5}]{2,10}$/u',
            ],
        ], [
            'required' => '角色名不能留空',
            'unique' => '角色名已存在',
            'name.regex' => '角色名只能由2-10位的中文组成',
        ]);

        $ids = $request->input('id'); // 权限id

        $name = $request->input('name'); // 角色名字

        if (empty($ids)) { // 为空则直接插入角色名
            $id = Roles::insertGetId(['name'=>$name]);
            if ($id) {
                return [
                    'code' => 1, // 代表插入成功
                    'msg' => '插入成功',
                ];
            } else {
                return [
                    'code' => 0, // 插入失败
                    'msg' => '插入失败,请重试',
                ];
            }
        } else { // 插入角色拥有的权限ID
            $id = Roles::insertGetId(['name'=>$name]);
            if ($id) {
                $data[0] = $id; // 角色id

                $data[1] = $ids; // 权限id

                $per = new Role_has_permissions;

                $res = $per->adds($data); // 插入角色拥有的权限
                return [
                    'code' => 1, 
                    'msg' => '插入成功',
                ];
            } else {
                return [
                    'code' => 0, // 插入失败
                    'msg' => '插入失败,请重试~',
                ];   
            }
        }
    }    
}