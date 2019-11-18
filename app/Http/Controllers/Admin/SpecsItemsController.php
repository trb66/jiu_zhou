<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Specs;
use App\Model\Admin\Spec_items;


class SpecsItemsController extends Controller
{
    //模型列表页
    public function index(Request $request)
    {
        // $types = DB::table('types')->distinct()->get();
        return view('/Admin/specsItems.SpecsItems');
    }

    //添加模型页
    public function add(Request $request)
    {
        //查出所有分类
        $types = DB::table('types')->distinct()->get();
        // dump($types);
        return view('/Admin/specsItems.add', ['types' => $types]);

    }
   
   //插入模型数据
    public function addSub(Request $request)
    {
         $this->validate($request, [
                 'type_id' => [
                    'required',
                ],
                 'name' => [
                     'required',
                     'regex:/^[\x{4E00}-\x{9FA5}A-Za-z_]+$/u',
                 ],

         ], [
               'required' => ':attribute不能为空',
               'name.regex' => '规格名字由中文字母和下划线组成',
         ]); 
         $SpesIte = $request->all();
         
         //验证属性值
         $preg_name = '/^[\x{4E00}-\x{9FA5}A-Za-z0-9_]+$/u';
         foreach ($SpesIte['time'] as $value) {
             if(!preg_match($preg_name, $value))
             {
                 return response()->json([
                'code' => '1',
                'msg' => '属性值只能是中文数字字母和下划线',
                 ], 500);
             }
         }

         //将属于spec的值用数组保存起来
         $spe = ['type_id' => $SpesIte['type_id'],'name' => $SpesIte['name']];

         //插入属性名
        $specs = new Specs;
        $res = $specs->addSub($spe);

        //属性值数据
        $itmes = $SpesIte['time'];
        $specs_id = $res['id'];

        //插入属性值
        $itme = new Spec_items;
        $valOk = $itme->addSub($specs_id,$itmes);
        if($valOk) {
            return ['yes'];
        }else {
             return response()->json([
                'code' => '1',
                'msg' => '服务器错误',
                 ], 500);
        }   
        

    }

}
