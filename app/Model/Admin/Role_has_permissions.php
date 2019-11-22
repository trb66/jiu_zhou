<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role_has_permissions extends Model
{
    // 添加权限
    public function adds($data)
    {
        $rid = $data[0]; // 角色ID

        $pid = $data[1]; // 权限ID

        foreach($pid as $v) {
            $datas = [
                'role_id' => $rid,
                'permission_id' => $v,
            ];
            Role_has_permissions::insert($datas); // 插入角色拥有的权限
        }
    }
}
