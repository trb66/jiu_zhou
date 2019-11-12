<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\lgz\types;

class TypesController extends Controller
{
    //分类列表
     public function index()
     {   
         
        //遍历types分类表
        $res = types::get();

        //发送给前台
        return view("Admin/types.types", ['types' => $res]);
     }
      

    //添加顶级分类
     public function add()
     {
       return view("Admin/types.typesAdd");
     }

    //将分类保存进分类表
     public function store(Request $request)
     {

         $name = $request->input('name');

         if($name) {
            $data = [];
            $data[] = [
                 'name' => $name,
                 'pid' => 0,
                 'path' => '0' . ',',
                 'created_at' => date('Y-m-d H:i:s'),
                 'updated_at' => date('Y-m-d H:i:s')
            ];
         $res = DB::table('types')->insert($data);
          if($res) {
             return '添加成功';
         }

         }else {
             return response()->json([
          // 'code' => 1,
             'msg' => '顶级分类不能为空' 

          ],500);
         }
     }

     //删除分类
     public function del(Request $request)
     {
        $id = $request->input('id');

        if($id) {
            $a = new types;
            $a->del($id);
            return '删除成功';  
        } else {
            return response()->json([
                'msg' => '删除失败'
            ], 500);
        }

     } 
    
}
