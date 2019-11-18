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
            dump($good);
            return view('/Admin/goodsPrices.goodsPrices',['good' => $good]);
        }
}