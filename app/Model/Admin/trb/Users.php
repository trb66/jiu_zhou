<?php

namespace App\Model\Admin\trb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    public function sel()
    {
        
    }

    public function userinfo()
    {
        return $this->hasOne('App\Model\Admin\trb\Users_infos', 'uid', 'id');
    }
}
