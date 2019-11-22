<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Users;
use App\Model\Admin\Users_infos;
use App\Model\Admin\Addrs;
use App\Model\Admin\Collects;
use App\Model\Admin\Goods;
use App\Model\Admin\Imgs;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 用户主页
    public function index(Request $request)
    {
        // 判断是否登陆
        $info = Users::where('id', session('UserInfo.id'))->first();
        return view('Home/User.userinfo', ['info' => $info]);
    }

    // 添加用户头像
    public function addphoto(Request $request)
    {
        // 1. 表单验证
        // exists 确定数据表中是否存在数据, 不存在则报错
        $this->validate($request, [
            'pic' => [
                'image',  
            ],
        ], [
            'pic.image' => '只能上传图片类型的文件',
        ], [
            // 'name' => '用户名',
        ]);
        $id = $request->input('id'); // 用户ID
        $fil = $request->file('pic'); // 文件

        $infos = Users_infos::where('uid', $id)->first();

        if ($infos && $infos->photo) { // 存在详细信息且存在头像
            $res = $fil->store('user_photo', 'public'); // 存储文件

            if ($res) { // 删除原来的，添加新的
                $img_path = ('/www/wwwroot/jiu_zhou/storage/app/public/'.$infos->photo); // 图片地址


                $s = Users_infos::where('uid', $id)->update(['photo' => $res]); // 插入新的图片地址

                unlink($img_path); // 删除图片

                if($s) {
                    return [
                        'code' => 1,
                        'msg' => '修改成功',
                        'path' => $res,
                    ];
                } else {
                    return response()->json([
                        'code' => 0,
                        'msg' => '网络错误，请重试',
                    ], 500);  
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '网络错误，请重试',
                ], 500);
            }
        } elseif($infos && !$infos->photo) { // 存在详细信息不存在头像
            $res = $fil->store('user_photo', 'public'); // 存储文件

            if ($res) { // 删除原来的，添加新的
                $s = Users_infos::where('uid', $id)->update(['photo' => $res]); // 插入新的图片地址

                if($s) {
                    return [
                        'code' => 1,
                        'msg' => '修改成功',
                        'path' => $res,
                    ]; 
                } else {
                    return response()->json([
                        'code' => 0,
                        'msg' => '网络错误，请重试',
                    ], 500);  
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '网络错误，请重试',
                ], 500);
            }
        } else { // 不存在详细信息，首次创建
            $res = $fil->store('user_photo', 'public'); // 存储文件

            if ($res) { // 删除原来的，添加新的
                $data = [
                    'uid' => $id,
                    'photo' => $res,
                ];
                $s = Users_infos::insertGetId($data); // 插入新的图片地址

                if($s) {
                    return [
                        'code' => 1,
                        'msg' => '修改成功',
                        'path' => $res,
                    ];
                } else {
                    return response()->json([
                        'code' => 0,
                        'msg' => '网络错误，请重试',
                    ], 500);  
                }
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '网络错误，请重试',
                ], 500);
            }
        }
    }

    // 修改用户信息
    public function edit(Request $request)
    {
        $id = $request->input('id'); // 用户ID

        $name = $request->input('name'); // 真实姓名

        $phone = $request->input('phone'); // 手机号

        $sex = $request->input('sex'); // 性别

        $email = $request->input('email'); // 邮箱

        $info = Users::where('id', '!=', $id)->where('phone', $phone)->first();

        $datas = [ // 修改信息
            'uid' => $id,
            'name' => $name, 
            'phone' => $phone, 
            'sex' => $sex, 
            'email' => $email, 
        ];

        if($info) {
            return response()->json([
                'code' => 0,
                'msg' => '该手机号已存在',
            ], 500);
        }
        

        // 修改users表的手机号
        $res = Users::where('id', $id)->update(['phone' => $phone]);

        $infos = Users_infos::where('uid', $id)->first();

        if ($res && $infos) { // 修改成功且存在详细信息
            $ss = Users_infos::where('uid', $id)->update($datas);
            if($ss) {
                return [
                    'code' => 1,
                    'msg' => '修改成功',
                ];    
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '网络错误，请重试',
                ], 500);  
            }
        } else if($res && !$infos) { // 修改成功且不存在详细信息
            $s = Users_infos::insertGetId($datas); // 创建新的信息
            if($s) {
                return [
                    'code' => 1,
                    'msg' => '修改成功',
                ];    
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '网络错误，请重试',
                ], 500);  
            }
        } else { // 修改失败
            return response()->json([
                'code' => 0,
                'msg' => '网络错误，请重试',
            ], 500);
        }
    }

    // 修改密码
    public function editpwd(Request $request)
    {
        return view('Home/User.editpwd');
    }

    // 显示修改密码
    public function showpwd(Request $request)
    {
        return view('Home/User.showepwd');
    }

    // 验证原密码
    public function yuanpwd(Request $request)
    {
        $pwd = $request->input('pwd');

        $info = Users::where('id', session('UserInfo.id'))->first();

        if (password_verify($pwd, $info['pwd'])) { // 判断密码是否正确
            dump(1);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '密码错误，请重试',
            ], 500);
        }
    }

    // 修改密码
    public function savepwd(Request $request)
    {
        $pwd = Hash::make($request->input('pwd'));

        $res = Users::where('id', session('UserInfo.id'))->update(['pwd' => $pwd]);

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
    }

    // 显示地址
    public function showaddress(Request $request)
    {
        $id = session('UserInfo.id'); // 用户id

        // 地址信息
        $addrinfo = Addrs::where('uid', $id)->orderBy('acquiescent')->get()->toArray();


        return view('Home/User.user_address', ['addrinfo' => $addrinfo]);
    }

    // 添加地址
    public function addaddress(Request $request)
    {
        $id = session('UserInfo.id'); // 用户id
        
        $def = $request->input('def');

        $adds = Addrs::where('uid', $id)->first();    

        if($adds && $def == '1') { // 存在其他地址，将其设为不默认
            Addrs::where('uid',$id)->update(['acquiescent' => 2]);
        }

        // 地址数据
        $data = [
            'uid' => $id,
            'username' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address'=> $request->input('addr'),
            'addrinfo' => $request->input('addinfo'),
            'acquiescent' => $def,
        ];

        $res = Addrs::insertGetId($data);
        if($res) {
            return [
                'code' => 1,
                'msg' => '添加成功',
            ];
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '网络错误，请重试',
            ], 500);
        }
    }

    // 删除地址
    public function deladdress(Request $request)
    {
        $aid = $request->input('id'); // 地址id

        $uid = session('UserInfo.id'); // 用户id

        $res = Addrs::where('id', $aid)->where('uid', $uid)->first();

        if($res) {
            $s = Addrs::where('id', $aid)->delete();
            if($s) {
                return [
                    'code' => 1,
                    'msg' => '删除成功',
                ];
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '服务器异常，请重试',
                ], 500);     
            }
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '服务器异常，请重试',
            ], 500); 
        }
    }

    // 设为默认地址
    public function defaultaddr(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID;

        $id = $request->input('id'); // 地址ID

        $res = Addrs::where('uid', $uid)->update(['acquiescent' => 2]);

        if($res) {
            $s = Addrs::where('uid', $uid)->where('id', $id)->update(['acquiescent' => 1]);
            if($s) {
                return [
                    'code' => 1,
                    'msg' => '修改成功',
                ];
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => '服务器异常，请重试',
                ], 500);     
            }
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '服务器异常，请重试',
            ], 500); 
        }
    }

    // 显示修改地址
    public function editaddr(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID;

        $id = $request->input('id'); // 地址ID

        $res = Addrs::where('uid', $uid)->where('id', $id)->first();

        if(!$res) {
            return redirect('/home/useraddress');
        }
        $arr = explode('-', $res->address);

        foreach($arr as $k => $v) {
            $addr = 'addr'.$k;
            $res->$addr = $v;
        }

        return view('Home/User.editaddr', ['editinfo' => $res]);
    }

    // 处理修改地址
    public function ceditaddr(Request $request)
    {
        $id = $request->input('id'); // 地址ID

        $uid = session('UserInfo.id'); // 用户ID

        if ($request->input('def') == 1) { // 修改所有的地址为2
            Addrs::where('uid', $uid)->update(['acquiescent' => 2]);
        }

        $data = [
            'username' => $request->input('name'),
            'address' => $request->input('addr'),
            'addrinfo' => $request->input('addrinfo'),
            'phone' => $request->input('phone'),
            'acquiescent' => $request->input('def'),
        ];

        $res = Addrs::where('id', $id)->update($data);
        if ($res) {
            return [
                'code' => 1,
                'msg' => '修改成功',
            ];
        } else {
            return response()->json([
                    'code' => 0,
                    'msg' => '服务器异常，请重试',
                ], 500); 
        }
    }

    // 显示收藏
    public function showcollect(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID

        $res = Collects::where('uid', $uid)->select('goods_id')->get();

        $goods_id = [];

        foreach($res as $k => $v) {
            $goods_id[$k] = $v->goods_id;
        }

        $goods = Goods::wherein('id', $goods_id)->paginate(8);

        foreach($goods as $k => $v) {
            $goods[$k]->img = Imgs::where('goods_id', $v->id)->where('img_type', '0')->first();
        }

        dump($goods);
        return view('Home/User.user_collection', ['collects' => $goods]);
    }
}
