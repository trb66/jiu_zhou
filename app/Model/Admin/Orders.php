<?php

namespace App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{

    public function show($sta,$text)
    {      

       if ($sta == '69' || $sta == 'null') return $this->paginate(4);
       // if($sta != '69' || $text == 'null' ) return $this->where('status',$sta)->paginate(3)->appends(['status'=> $sta]);
  

       return $this->paginate(4);
    }
 
    public function nickname()
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
     

    public function order_edit($id,$data) 
    {

     return $this->where('id',$id)->update($data);



    }

    public function search()
    {   
         
        return $this->paginate(2);
        // return $this->where('status','=',$_GET['order_status'])->paginate(2);
    }
   
}    

