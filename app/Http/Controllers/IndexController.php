<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    // 后台首页
    public function index() 
    {
        return view('Admin/index');
    }


    public function test() 
    {
        return view('Admin/test');
    }
}



