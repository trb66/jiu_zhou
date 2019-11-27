<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Spec_goods_prices;


class GoodsPricesController extends Controller
{
        public function index(Request $request)
        { 
            //查goods表的数据
            $good = DB::table('goods')->where($request->all())->first(); 
            $type_id = $good->cid;
            //通过goods的cid查出specs表的数
            $specs = DB::table('specs')->where('type_id', $good->cid)->get()->toArray();
            // $id = $specs['type_id'];
            // 查出该v所拥有的属性值
            $spec_items = []; 
            foreach ($specs as $k => $v) {
                // $id[$k] = $v->id;
            $spec_items[] = DB::table('spec_items')->where('spec_id', $v->id)->get()->toArray();
                
            }
            foreach ($specs as $k => $v) {
                $v->value = $spec_items[$k];
            }

            // dd($specs);
           
            return view('/Admin/goodsPrices.goodsPrices',['good' => $good, 'specs' => $specs]);
        }

        public function add(Request $request) 
        {   
            $this->validate($request, [
                       'key_id' => [
                             'required', 
                       ],
                       'goods_id' => [
                             'required',
                       ],
                       'key_name' => [
                             'required',  
                       ],
                       'price' => [
                              'required',
                              'numeric',
                              'digits_between:1,999999.99',
                       ],
                       'store_count' => [
                               'required',
                               'numeric',
                               'digits_between:1,999999999',
                       ],
            ], [
                       'required' => ':attribute 不能为空',
                       'price:digits_between' => '最大长度不能超过999999.99',
                       'price:digits' => '值必须是数值',
                       'store_count:digits_between' => '最大长度不能超过99999999',
                       'store_count:digits' => '值必须是数值',

            ], [
                       'key_id' => '属性值ID',
                       'goods_id' => '商品ID',
                       'key_name' => '规格全名',
                       'price' => '每个规格的商品价格',
                       'store_count' => '每个规格的库存',
            ]);
            $specGoodsPrices = $request->all();
            $goods_id = $specGoodsPrices['goods_id'];
            $key_name = $specGoodsPrices['key_name'];
            $fir = DB::table('spec_goods_prices')->where('goods_id', $goods_id)->where('key_name', $key_name)->first();
            // dd($fir);
            if($fir) {
                    return response()->json([
                        'code' => '1',
                        'msg' => '该规格已存在',
                  ], 500);
            }else {

                $sgp = new Spec_goods_prices;
                $res = $sgp->specGoodPrice($specGoodsPrices);
                if($res) {
                        return [
                        'code' => '1',
                        'msg' => '添加成功'
                    ];
                } else {
                    return response()->json([
                    'code' => '1',
                    'msg' => '服务器繁忙'
                ], 500);
                }   
            }
        }

        public function del(Request $request)
        { 
              $id = $request->all('id');
              dump($id);
              $res = DB::table('specs')->where($id);
              $spec = $res->first();
              if($spec) {
                dump(123);
                 $res->delete();
                 DB::table('spec_items')->where('spec_id', $id)->delete();

              }else {
                return response()->json([
                   'code' => '1',
                   'msg' => '服务器繁忙',
                ], 500);
              }

        }
}