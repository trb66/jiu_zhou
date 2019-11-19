<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Goods;


class GoodsController extends Controller
{
    //显示商品列表
    public function index() 
    {
        //遍历goods商品表
        $page = 12;
        $ty = new Goods;
        $res = $ty->goods($page);
        return view("Admin/goods.goods", ['goods' => $res]);
    }

    //添加商品页面
    public function goodsAdd()
    { 
        //将所有分类查出来并按子父级排序
        $types = DB::table('types')->orderBy(DB::raw('concat(path,id)'))->get();
        return view("Admin/goods.goodsAdd", ['types' => $types]);
    }

    //添加商品
    public function addSub(Request $request)
    {
        //表单验证
        $this->validate($request,[
                'cid' => [
                      'required',
                ],
                'name' => [
                      'required',
                      'regex:/^\S+.{2,90}$/',
                      'unique:goods',
                ],
                'price' => [
                       'required',
                       'regex:/^(?:0\.\d{0,1}[1-9]|(?!0)\d{1,6}(?:\.\d{0,1}[1-9])?)$/',

                ],
                'company' => [
                       'required',
                       'regex:/^[\x{4E00}-\x{9FA5}A-Za-z0-9_]+$/u',
                ],
                'status' => [
                       'required',
                       'regex:/[0|1]/',
                ], 
        ],[
                'required' => ':attribute 不能为空',
                'name.regex' => '商品名称必须是3~30个字符之内',
                'name.unique' => '该商品已存在',
                'price.regex' => '价格范围是999999.99 ~ 0.01',
                'company.regex' => '商家名必须字母数字和下划线组成',
                'status' => '状态错误', 

        ],[
                'cid' => '所属分类',
                'name' => '商品名称',
                'price' => '商品价格',
                'company' => '商家名',
                'status' => '状态',

        ]);
        
        // //如果通过就保存数据
        $data = $request->all();
        $good = new Goods();
        $res = $good->addSub($data); 
        //成功后返回结果给ajax
        return ["yes"];
    }

    //编辑商品
    public function edit(Request $request)
    {
        $id = $request->input('id');

        $goods = DB::table('goods')->where('id', $id)->first();

        $types = DB::table('types')->orderBy(DB::raw('concat(path,id)'))->get();

        return view('Admin/goods.edit', ['types' => $types, 'goods' => $goods]);
    }

    public function editSub(Request $request)
    {  
        //表单验证
        $name = $request->input('name');
        $id = $request->input('id');
        //判断name=name并且id!=id的数据是否存在，存在证明有该商品名了
        $res = DB::table('goods')->where('name',$name)->where('id','!=',$id)->first();
        if($res) {
            return response()->json([
                'code' => '1',
                'msg' => '该商品已存在'
            ], 500);
        } else {     
            $test = $request->input('test');
            
            $this->validate($request,[
                    'cid' => [
                          'required',
                    ],
                    'name' => [
                          'required',
                          'regex:/^\S+.{2,90}$/',
                          
                    ],
                    'price' => [
                           'required',
                           'regex:/^(?:0\.\d{0,1}[1-9]|(?!0)\d{1,6}(?:\.\d{0,1}[1-9])?)$/',

                    ],
                    'company' => [
                           'required',
                           'regex:/^[\x{4E00}-\x{9FA5}A-Za-z0-9_]+$/u',
                    ],
                    'status' => [
                           'required',
                           'regex:/[0|1]/',
                    ],

            ],[
                    'required' => ':attribute 不能为空',
                    'name.regex' => '商品名称必须是3~30个字符之内',
                    'name.unique' => '该商品已存在',
                    'price.regex' => '价格范围是999999.99 ~ 0.01',
                    'company.regex' => '商家名必须字母数字和下划线组成',
                    'status' => '状态错误', 

            ],[
                    'cid' => '所属分类',
                    'name' => '商品名称',
                    'price' => '商品价格',
                    'company' => '商家名',
                    'status' => '状态',

            ]);
              // //如果通过就保存数据
             $data = $request->all();
             $good = new Goods();
             $res = $good->editSub($data); 
             //成功后返回结果给ajax
             return response()->json([
                'msg' => '编辑成功'
            ], 200);

        }

    }
    public function del(Request $request) 
    {  
       $id = $request->all();
       $good = new Goods();
       $res = $good->del($id);
       if($res) {         
           return response()->json([
                'code' => '0',
                'msg' => '删除成功'
          ],200); 
       }else {
           return response()->json([
                'code' => '1',
                'msg' => '删除是失败'
            ],500); 
       }
       

    }
}
