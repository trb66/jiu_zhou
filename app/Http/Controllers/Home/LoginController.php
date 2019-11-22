<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin\Users;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;


class LoginController extends Controller
{
    // 登陆页面
    public function index(Request $request)
    {
        // 判断是否登陆
        if (session('UserisLogin')) {
            return view('Home/index');
        } else {
            return view('Home/Login.index');
        }
    }

    // 退出登陆
    public function logout(Request $request)
    {
        $request->session()->forget('UserisLogin');
        $request->session()->forget('UserInfo');
        return redirect('/');
    }

    // 处理登陆
    public function login(Request $request)
    {
        // 表单验证
        $this->validate($request, [
            'phone' => [
                'exists:users',
            ],
        ], [
            'phone.exists' => '手机号错误',
        ]);
        $phone = $request->input('phone');
        $pwd = $request->input('pwd');

        $info = Users::where('phone', $phone)->first()->toArray();

        if ($info['status'] == 1) { // 判断账户状态
            return response()->json([
                'code' => 0,
                'msg' => '该账户已被封',
            ], 500);
        }
        if (password_verify($pwd, $info['pwd'])) { // 密码通过
            // 保存登陆状态
            session([
                'UserisLogin' => true,
                'UserInfo' => [
                    'id' => $info['id'],
                    'username' => $info['username'],
                ],
            ]);
            // 跳转到前台首页
            return [
                'code' => 1,
            ];
        } else { // 密码错误
            return response()->json([
                'code' => 0,
                'msg' => '密码错误',
            ], 500);
        }
        // dump($info);


    }


    // 发送验证码
    public function registeryzm(Request $request)
    {
        $phone = $request->input('phone'); // 手机号

        $code = rand(100000, 999999); // 验证码

        include public_path('Static/Lib/ronglian/Demo/SendTemplateSMS.php'); // 引入文件

        // 值1手机号， 值2验证码
        sendTemplateSMS($phone,[$code],1);

        cache([$phone => $code],Carbon::now()->addSeconds(120)); // 将验证码缓存起来
        return [
            'code' => 1,
            'msg' => '发送成功',
        ];

    }

    // 处理验证码
    public function register(Request $request)
    {
        // 表单验证
        $this->validate($request, [
            'username' => [
                'unique:users',
            ],
            'phone' => [
                'unique:users',
            ],
        ], [
            'username.unique' => '用户名 已经存在',
            'phone.unique' => '一个手机号只能注册一个账户',
        ]);

        $phone = $request->input('phone'); // 手机号

        $yzm = $request->input('yzm'); // 验证码

        $name = $request->input('username'); // 用户名

        $pwd = $request->input('pwd'); // 密码

        // 拿出缓存中的验证码
        $val = cache($phone);

        if ($val == $yzm) { // 验证通过
            $data = [
                'username' => $name,
                'pwd' => Hash::make($pwd),
                'phone' => $phone,
                'status' => 0,
            ];
            $res = Users::insertGetId($data);
            if ($res) {
                return [
                    'code' => 1,
                    'msg' => '添加成功',
                ];
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '网络错误,请重试',
                ], 500);   
            }
        } else { // 验证码不通过
            return response()->json([
                'code' => 0,
                'msg' => '验证码错误',
            ], 500);
        }
    }

    // 判断号码是否存在
    public function isphone(Request $request)
    {
        // 表单验证
        $this->validate($request, [
            'phone' => [
                'exists:users',
            ],
        ], [
            'phone.exists' => '手机号不存在',
        ]);
    }

    // 重置密码发送验证码
    public function resyzm(Request $request)
    {
        $phone = $request->input('phone'); // 手机号

        $code = rand(100000, 999999); // 验证码

        include public_path('Static/Lib/ronglian/Demo/SendTemplateSMS.php'); // 引入文件

        // 值1手机号， 值2验证码
        sendTemplateSMS($phone,[$code],1);

        cache([$phone => $code],Carbon::now()->addSeconds(120)); // 将验证码缓存起来
        return [
            'code' => 1,
            'msg' => '发送成功',
        ];
    }

    // 重置密码
    public function respwd(Request $request)
    {
        $phone = $request->input('phone');

        $pwd = $request->input('pwd');

        $yzm = $request->input('yzm');

        // 拿出缓存中的验证码
        $val = cache($phone);

        if ($yzm == $val) { // 验证通过
            $res = Users::where('phone', $phone)->update(['pwd' => Hash::make($pwd)]);
            if($res) {
                return [
                    'code' => 1,
                ];                
            } else {
               return response()->json([
                    'code' => 0,
                    'msg' => '网络错误，请重试',
            ], 500); 
            }
        } else { // 不通过
            return response()->json([
                    'code' => 0,
                    'msg' => '验证码错误',
            ], 500);
        }
    }


}
