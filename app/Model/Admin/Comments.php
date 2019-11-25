<?php

namespace App\Model\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    public function list($username)
    {
       
      if ($username != '') {

         $ress = DB::table('users')
                        ->where('username','like','%'.$username.'%')
                        ->get();
         $uid = [];
		 foreach ($ress as $k => $v) {
		   
		   $uid[$k] = $v->id;
		 }

		 return $this->whereIn('uid',$uid)
		             ->where('pid', '=', '0')
		             ->get();
      }
 
      return $this->where('pid','0')->paginate(4);

    }

    public function username()
    {
        return $this->hasOne('\App\Model\Admin\Users', 'id', 'uid');

    }

      public function gname()
    {
        return $this->hasOne('\App\Model\Admin\Goods', 'id', 'gid');
    	
    }

    public function reply($id)
    {
 
      return $this->where('id', $id)
                  ->orwhere('pid',$id)
                  ->orderBy('created_at')
                  ->get();

    }

    public function addreply($data)
    { 
       $all = [
          'uid' => $data['uid'],
          'gid'=>$data['gid'],
          'text' => $data['text'],
          'type' => '1',
          'pid' => $data['id'],
       ];
       
       return $this->insert($all);

    }

    public function goodsName()
    {
      return $this->hasOne('\App\Model\Admin\Goods', 'id', 'gid');
    }

    public function goodImgs()
    {
      return $this->hasOne('\App\Model\Admin\Imgs', 'goods_id', 'gid');
    }
}
