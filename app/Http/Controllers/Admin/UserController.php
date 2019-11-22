<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Users;
use App\Model\Admin\Users_infos;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user_list = Users::paginate(4);

        $sts = $request->input('status'); // 状态

        $str = $request->input('str'); // 模糊搜索

        // 1.只搜索状态
        if ($sts != null && $str == null) {
            $user_list = Users::where('status', $sts)
                        ->paginate(4)
                        ->appends(['status' => $sts]);
        }
        // 2.只搜索名字
        if ($sts == null && $str != null) {
            $user_list = Users::where('username', 'like', '%'.$str.'%')
                        ->paginate(4)
                        ->appends(['str' => $str]);
        }
        // 3.都搜索
        if ($sts != null && $str != null) {
            $user_list = Users::where('username', 'like', '%'.$str.'%')
                        ->where('status', $sts)
                        ->paginate(4)
                        ->appends(['str' => $str]);
        }

        return view('Admin/user.index', ['user_list' => $user_list]); 
    }

    public function status(Request $request)
    {
        $id = $request->input('id');

        $res = Users::find($id);
        if ($res->status == 0) { // 正常，禁用
            $res->status = 1;
            if(!$res->save()) {
                return response()->json([
                        'code' => 0,
                        'msg' => '服务器错误，请重试~',
                    ], 500);
            }
        } else {
            $res->status = 0;
            if(!$res->save()) {
                return response()->json([
                        'code' => 0,
                        'msg' => '服务器错误，请重试~',
                    ], 500);
            }
        }
        return [
            'code' => 1,
        ];
    }
}