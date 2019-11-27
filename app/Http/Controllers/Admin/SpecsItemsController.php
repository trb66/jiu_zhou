<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Specs;
use App\Model\Admin\Spec_items;
use App\Model\Admin\Spec_goods_prices;


class SpecsItemsController extends Controller
{
    //模型列表页
    public function index(Request $request)
    {   
        //查询Spec_goods_prices表所有的数据
        $pag = 15;
        //用商品名模糊搜索
        $name = $request->input('name');
        if($name != null) {
            $goods = DB::table('goods')->where('name', 'like', '%'.$name.'%')->paginate($pag);
            $id = [];
            foreach ($goods as $key => $value) { 
                 $id[$key] = $value->id;
            }
             $specGoodsPrices = Spec_goods_prices::wherein('goods_id', $id)->paginate($pag);
        }else {
            $specGoodsPrices = Spec_goods_prices::paginate($pag);
        }
        return view('/Admin/specsItems.SpecsItems', ['specGoodsPrices' => $specGoodsPrices]);
    }

    //添加模型页
    public function add(Request $request)
    {
        //查出所有分类
        $types = DB::table('types')->distinct()->get();
        $id = $request->all();
        return view('/Admin/specsItems.add', ['types' => $types, 'id' => $id]);
 
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
         // 插入属性名
        $specs = new Specs;
        $res = $specs->addSub($spe);

        //属性值数据
        $itmes = $SpesIte['time'];
        $specs = DB::table('specs')->where('name',$SpesIte['name'])->where('type_id', $SpesIte['type_id'])->first();
        $specs_id = $specs->id;
        // //插入属性值
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

    //删除spec_goods_pnces里面的数据
    public function del(Request $request) 
    {
       $id = $request->all();
       $delOK = DB::table('spec_goods_prices')->where($id);
       if($delOK) {
         $delOK->delete();
         return ['删除成功'];
       }else {
        return response()->json([
             'msg' => '删除失败',
        ], 500);
       }

    }

}
