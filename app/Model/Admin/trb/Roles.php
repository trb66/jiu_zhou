<?php

namespace App\Model\Admin\trb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roles extends Model
{
    // 添加角色
    public function adds()
    {

    }

    // 批量删除
    public function delall($data)
    {
        DB::beginTransaction(); // 开启事务
        foreach($data as $v) {
            $res = $this->destroy($v); // 删除角色
            if($res) { // 判断角色是否拥有权限
                $r_per = Role_has_permissions::where('role_id', $v)->get()->toArray();
                if(!empty($r_per)) {
                    $dels = Role_has_permissions::where('role_id', $v)->delete(); // 删除权限ID
                    if (!$dels) {
                        DB::rollBack(); // 回滚事务
                        return 0;                                
                    }
                }
            } else { // 删除失败
                DB::rollBack(); // 回滚事务
                return 0;
            }
        }
        DB::commit(); // 提交事务
        return 1;
    }
}
