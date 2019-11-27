<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin\Admin;

class LoginController extends Controller
{
    // 登陆页面
    public function login(Request $request)
    {
        if ($request->session()->has('adminisLogin')) {
            return redirect('/admin');
        } else {
            return view('Admin/Login.login');
        }
    }

    public function chulilog(Request $request) 
    {
        // 1. 表单验证
        // exists 确定数据表中是否存在数据, 不存在则报错
        $this->validate($request, [
            'name' => 'exists:admins',
        ], [
            'exists' => '用户名 错误'
        ]);

         // 2. 验证身份

        $name = $request->get('name');

        $pwd = $request->get('pwd');

        $rem = $request->get('status');

        $info = Admin::where('name', $name)->first()->toArray();

        if (password_verify($pwd, $info['pwd'])) { // 验证密码是否正确
            if ($info['status'] == 1) { // 验证账户是否被禁用
                return [
                    'code' => '0',
                    'msg' => '该用户暂时不可用',
                ];
            } else {
                // 保存登陆状态
                session([
                    'adminisLogin' => true,
                    'adminInfo' => [
                        'id' => $info['id'],
                        'name' => $info['name'],
                    ],
                ]);
                // 跳转到后台首页
                return [
                    'code' => 1,
                ];
            }
        } else { // 密码不通过
            return [
                'code' => '0', // 代表失败
                'msg' => '密码有误',
            ];
        }
    }

    public function logout(Request $request)
    {
        // 处理退出
        $request->session()->forget('adminisLogin');
        $request->session()->forget('adminInfo');
        return redirect('/admin/login');

    }
}



