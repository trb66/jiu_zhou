<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


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

        // public function selIte(Request $request)
        // {
        //     //通过specsID查出其所拥有的items数据
        //     $items = DB::table('spec_items')->where($request->all())->get();
        //     return $items;

        // }
}