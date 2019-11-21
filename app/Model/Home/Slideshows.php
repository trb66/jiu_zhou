<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slideshows extends Model
{
    public function sel()
    {
        return $this->where('status','=','1')->get()->toArray();
    }
}