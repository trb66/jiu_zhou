<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    public function userinfo()
    {
        return $this->hasOne('App\Model\Admin\Users_infos', 'uid', 'id');
    }
}   
