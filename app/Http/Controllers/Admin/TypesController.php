<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Types;

class TypesController extends Controller
{
    //分类列表
     public function index(Request $request)
     {   
         $id = $request->input('id');
         $cid = $request->input('cid');
         // dump($cid);

        //遍历types分类表
        $page = 15;
        if( $cid != null) {
            $type = types::get();
            $res = types::where('id', $cid)->orWhere('pid', $cid)->paginate($page); 
        }elseif($id != null) {
            $type = types::get();
            $res = types::where('id', $id)->orWhere('pid', $id)->paginate($page);
        }else {
            
         $res = types::orderBy(DB::raw('concat(path,id)'))->paginate($page);
         $type = types::get();
        }


        //发送给前台
        return view("Admin/types.types", ['types' => $res, 'type' => $type, 'id' => $id, 'cid' => $cid ]);
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
        //input拿过来的是一个数组
        $arrpath = $request->input('path');
        $id = $arrpath['id'];
        $path = $arrpath['path'];
        $pathId = $path.$id.',';
        //判断其下面是否有子级
        $trues = DB::table('types')->where('path', $pathId)->first();
        //判断其下面有无商品
        $goods = DB::table('goods')->where('cid', $id)->get()->toArray();
     
        if($trues) {
            return response()->json([
                'msg' => '请先删除该子级'
            ], 500);
        } elseif($goods) {
            return response()->json([
                'msg' => '不能删除有商品的分类'
            ], 500);
        } else {   
            $a = new types;  // new types 模成类
            $a->del($id);    //把id分配给del模层
            return response()->json([
                'msg' => '删除成功'
            ],200); 

        }

     }

     //编辑分类
     public function red() 
     {
        $res = DB::table('types')
             ->where('id', $_GET['id'])
             ->first();  
        return view('Admin/types.typesRed', ['types' => $res]);
     }

     //修改分类
     public function edit()
     {  
        //获取修改后的分类名字
       $name = $_POST['name'];
       $id = $_POST['id'];

       // 判断数据表是否有同名的;
       $findName = DB::table('types')->where('name', $name)->first();
       if($findName) {
          return response()->json([
          'code' => 1,
          'msg' => '该分类已存在，请重新添加新分类' 
          ],500);
       } else {
          $a = new types;
          $a->edit($_POST);
          return ["yes"];
       }

     }

     //显示子集分类页
     public function addSon()
     {
        $types = DB::table('types')->where('id', $_GET['id'])->first();
        // dump($types);
        return view('Admin/types.addSon', ['types' => $types]);
     }

    //提交添加子级
     public function addSub()
     {
        $findName = DB::table('types')->where('name', $_POST['name'])->first();
        if(!$findName) {
            $add = new types;
            $add->addSub($_POST);         
            return ["yes"];
        } else {
           return response()->json([
          'code' => 1,
          'msg' => '该分类已存在，不能添加已有分类,请重新添加新分类' 
          ],500);
        }

     }
    
}
