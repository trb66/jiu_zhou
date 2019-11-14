<?php

namespace App\Model\Admin\trb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\trb\User_has_roles;

class Admin extends Model
{
    public function adds($data)
    {
        $its = [
            'name' => $data['name'],
            'pwd' => Hash::make($data['pwd']),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // 插入后台用户信息
        DB::beginTransaction(); // 开启事务
        $adm = new Admin;
        $id = $adm->insertGetId($its);
        // 如果插入成功,继续插入用户拥有的角色id
        if ($id) {
            if (!empty($data['roles'])) {
                foreach($data['roles'] as $v) {
                    $rols = [
                        'user_id' => $id,
                        'role_id' => $v,
                    ];
                    $uids = User_has_roles::insertGetId($rols);// 插入用户拥有的角色id
                    if (!$uids) {
                        DB::rollBack(); // 回滚事务
                        return 0;
                    }
                }
            }
            DB::commit(); // 提交事务
            return 1; // 1代表插入成功
        } else {
            DB::rollBack(); // 回滚事务
            return 0; // 0代表插入失败
        }
    }

    public function edits($data)
    {   
        $users = Admin::find($data['id']);
        $users->name = $data['name'];
        $users->email = $data['email'];
        $users->phone = $data['phone'];
        $users->status = $data['status'];

        DB::beginTransaction(); // 开启事务

        $res = $users->save(); // 更新数据
        if ($res) { // 修改成功，判断是否要添加角色
            if (!empty($data['roles'])) { // 不为空，添加角色
                $ss = User_has_roles::where('user_id', $data['id'])->get()->toArray();
                if (!empty($ss)) {
                    $dres = User_has_roles::where('user_id', $data['id'])->delete();
                    if ($dres) {
                        foreach($data['roles'] as $v) {
                                $rols = [
                                    'user_id' => $data['id'],
                                    'role_id' => $v,
                                ];

                                $uids = User_has_roles::insertGetId($rols);//插入用户拥有的角色id    
                                if (!$uids) {
                                    DB::rollBack(); // 回滚事务
                                    return 0; // 修改失败
                                }           
                        }
                        DB::commit(); // 提交事务
                        return 1;
                    } else {
                        return 0;
                        DB::rollback(); // 回滚事务
                    }
                } else {
                    foreach($data['roles'] as $v) {
                        $rols = [
                        'user_id' => $data['id'],
                        'role_id' => $v,
                        ];

                        $uids = User_has_roles::insertGetId($rols);//插入用户拥有的角色id    
                        if (!$uids) {
                            DB::rollBack(); // 回滚事务
                            return 0; // 修改失败
                        }           
                    }
                    DB::commit(); // 提交事务
                    return 1; 
                }
            } else { // 删除所有的角色
                $s = User_has_roles::where('user_id', $data['id'])->get()->toArray();
                if (!empty($s)) {
                    $res = User_has_roles::where('user_id', $data['id'])->delete();
                    if($res) {
                        DB::commit(); // 删除成功，提交事务
                        return 1;
                    } else {
                        DB::rollBack(); // 提交事务
                        return 0;
                    }
                } else {
                    DB::commit(); // 提交事务
                    return 1;
                }
            }
        } else { // 修改失败，返回错误
            DB::rollBack(); // 提交事务
            return 0;
        }
    }

    public function editsp($data)
    {
        $users = Admin::find($data['id']);

        $users->name = $data['name'];
        $users->pwd = Hash::make($data['pwd']);
        $users->email = $data['email'];
        $users->phone = $data['phone'];
        $users->status = $data['status'];

        DB::beginTransaction(); // 开启事务

        $res = $users->save(); // 更新数据
        if ($res) { // 修改成功，判断是否要添加角色
            if (!empty($data['roles'])) { // 不为空，添加角色

                foreach($data['roles'] as $v) {

                    $urs = User_has_roles::where('user_id', $data['id'])
                                    ->where('role_id', $v)
                                    ->first();

                    if ($urs == null) { // 为null代表角色不存在，添加
                        $rols = [
                            'user_id' => $data['id'],
                            'role_id' => $v,
                        ];

                        $uids = User_has_roles::insertGetId($rols);//插入用户拥有的角色id    

                        if (!$uids) {
                            DB::rollBack(); // 回滚事务
                            return 0; // 修改失败
                        }           
                    }
                }
                DB::commit();
                return 1; // 添加角色成功
            } else {
                DB::commit(); // 不添加角色，提交事务
                return 1;
            }
        } else { // 修改失败，返回错误
            DB::rollBack(); // 提交事务
            return 0;
        }
    } 

    public function dellalls($ids) // 删除所有用户
    {
        DB::beginTransaction(); // 开启事务

        $res = Admin::destroy($ids); // 删除用户

        if ($res) { // 删除用户拥有的角色
            foreach ($ids as $v) {
                $rols = User_has_roles::where('user_id', $v)->get()->toArray();
                
                if (!empty($rols)) {
                    $ress = User_has_roles::where('user_id', '=', $v)->delete();
                    if (!$ress) {
                        return 0; // 删除失败
                        DB::rollBack(); // 回滚事务
                    }
                }
            }
            DB::commit();//成功，提交事务
            return 1; // 代表删除成功
        } else {
            DB::rollBack();//失败，回滚事务
            return 0;
        }
    }
}
