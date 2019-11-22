<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    // 添加权限
    public function add($data)
    {
        return Permissions::insert($data);
    }
}