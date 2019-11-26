<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function item_comment($id)
    {
       
       $comment =  $this->where('gid',$id)->get();
       $com =  $this->where('gid',$id)
                    ->where('type' ,'!=','1')
                    ->count();
       return [$comment, $com];
    }
    public function item_user()
    {
    	return $this->hasOne('App\Model\Home\Users','id','uid');
    }

     public function item_userinfo()
    {
      return $this->hasOne('App\Model\Home\Users_infos','uid','uid');
    }
     public function item_orderx()
    {
      return $this->hasOne('App\Model\Home\Order_derails','uid','uid');
    }
}
