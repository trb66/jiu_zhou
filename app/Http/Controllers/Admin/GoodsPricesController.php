<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class GoodsPricesController extends Controller
{
        public function index(Request $request)
        { 
            $good = DB::table('goods')->where($request->all())->first(); 
            $type_id = $good->cid;
            $specs = DB::table('specs')->where('type_id', $type_id)->get();
            dump($specs); 
            return view('/Admin/goodsPrices.goodsPrices',['good' => $good, 'specs' => $specs]);
        }
}