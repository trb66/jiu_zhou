<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Roles;
use App\Model\Admin\Permissions;
use App\Model\Admin\Role_has_permissions;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // 角色列表
    public function index(Request $request)
    {
        $rolelist = Roles::paginate(4);

        $str = $request->input('str'); // 模糊搜索

        // 只搜索名字
        if ($str != null) {
            $rolelist = Roles::where('name', 'like', '%'.$str.'%')
                        ->paginate(4)
                        ->appends(['str' => $str]);
        }

        return view('Admin/role.list', ['rolelist' => $rolelist]);
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

    // 删除角色
    public function del(Request $request)
    {
        $rid = $request->input('id');


        $res = Roles::destroy($rid);

        if($res) { // 删除成功，查看该角色下面是否有权限Id
            $rols = Role_has_permissions::where('role_id', $rid)->get();
            if ($rols) {
                Role_has_permissions::where('role_id', $rid)->delete();
                return [
                    'code' => 1,
                    'msg' => '删除成功',
                ];
            }
            return [
                'code' => 1,
                'msg' => '删除成功',
            ];
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '服务器错误，请重试~',
            ], 500);
        }
    }

    // 批量删除角色
    public function delall(Request $request)
    {
        $ros = new Roles;

        $rids = $request->input('r_id');

        $res = $ros->delall($rids);
        if($res) { // 删除成功
            return [
                'code' => 1,
                'msg' => '删除成功',
            ];
        } else { // 删除失败
            return response()->json([
                        'code' => 0,
                        'msg' => '删除失败，请重试~',
                    ], 500);
        }
    }

    // 修改
    public function edit(Request $request)
    {
        $id = $request->input('id');

        $roleinfo = Roles::where('id', $id)->first()->toArray(); // 角色信息

        $ros = Role_has_permissions::where('role_id', $id)->select('permission_id')->get()->toArray(); // 查出角色拥有的权限

        $pers = Permissions::get()->toArray(); // 所有权限

        return view('Admin/role.edit', ['roleinfo'=>$roleinfo, 'pers' => $pers, 'ros' => $ros]);
    }

    public function cedit(Request $request)
    {
        // 1. 表单验证
        $this->validate($request, [
            'name' => [
                'required',
                'regex:/^[\x{4E00}-\x{9FA5}]{2,10}$/u',
            ],
        ], [
            'required' => '角色名不能留空',
            'name.regex' => '角色名只能由2-10位的中文组成',
        ]);
        $name = $request->input('name'); // 角色名字

        $id = $request->input('id'); // 角色ID

        $pres = $request->input('pres'); // 角色权限ID

        $res = Roles::where('name', $name)->where('id', '!=', $id)->first();

        if (empty($res)) { // 修改角色
            $roles = Roles::find($id);

            $roles->name = $name;

            $sas = $roles->save();
            if ($sas) { // 修改成功，继续修改角色拥有的权限
                if (empty($pres)) { // 删除用户所有的权限
                    $pes = Role_has_permissions::where('role_id', $id)->get();
                    if ($pes) {
                        $dels = Role_has_permissions::where('role_id', $id)->delete();
                        return [
                            'code' => 1, // 代表修改成功
                            'msg' => '修改成功',
                        ];
                    } else {
                        return [
                            'code' => 1, // 代表修改成功
                            'msg' => '修改成功',
                        ];
                    }
                } else {
                    $pes = Role_has_permissions::where('role_id', $id)->get();
                    if ($pes) { // 代表角色拥有权限，删除后添加
                        $dels = Role_has_permissions::where('role_id', $id)->delete();
                        foreach($pres as $v) {
                            $its = [
                                'role_id' => $id,
                                'permission_id' => $v,
                            ];
                            Role_has_permissions::insertGetId($its);
                        }
                        return [
                            'code' => 1,
                            'msg' => '修改成功'
                        ];
                    } else { // 代表角色没有权限，直接添加
                        foreach($pres as $v) {
                            $its = [
                                'role_id' => $id,
                                'permission_id' => $v,
                            ];
                            Role_has_permissions::insertGetId($its);
                        }
                        return [
                            'code' => 1,
                            'msg' => '修改成功'
                        ];
                    }
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '服务器繁忙~',
                ], 500);    
            }
        } else { // 角色名存在
            return response()->json([
                'code' => 0,
                'msg' => '角色名字已存在',
            ], 500);
        }
    }
}