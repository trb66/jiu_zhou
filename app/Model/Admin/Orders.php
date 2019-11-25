<?php

namespace App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{

    public function show($sta,$text,$uid)
    {      

       if ($sta == '69' || $sta == '') return $this->paginate(4);
       if($sta != '69' || $text == '' ) return $this->where('status',$sta)->paginate(3)->appends(['status'=> $sta]);
       if($sta == '69' || $text != '') {

          return $this->where('uid',$uid)->get();
      
       }

    }
 
    public function username()
    {
        return $this->hasOne('\App\Model\Admin\Users', 'id', 'uid');
    }

    public function addr()
    {
        return $this->hasOne('\App\Model\Admin\Addrs', 'id', 'aid');
        
    }
     public function uinfo()
    {
        return $this->hasOne('\App\Model\Admin\Users_infos', 'uid', 'uid');
        
    }
     public function goods()
    {
        return $this->hasOne('\App\Model\Admin\Goods', 'id', 'gid');
        
    }

    public function del($id)
    {
     
      return  $this->where('id' ,'=',$id)->delete();


    }

    public function alter($id)
    {

      return $this->where('id','=',$id)->first();
       
    }
     

    public function search()
    {   
         
          
        return $this->paginate(2);
        // return $this->where('status','=',$_GET['order_status'])->paginate(2);
    }
   
   public function orderInfo()
   {
      return $this->hasMany('App\Model\Admin\Orders_details', 'oid', 'id');    
   }

   public function orderComm()
   {
      return $this->hasMany('App\Model\Admin\Comments', 'oid', 'id');    
   }
}    

