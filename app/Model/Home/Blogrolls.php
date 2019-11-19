<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blogrolls extends Model
{
    public function find()
    {
        return $this->where('status','=','1')->get()->toArray();
    }
}
