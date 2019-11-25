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
use App\Model\Admin\Comments;
use App\Model\Admin\Orders;
use App\Model\Admin\Expresses;
use App\Model\Admin\Orders_details;

use Illuminate\Support\Facades\DB;
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
    public function addPhoto(Request $request)
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
    public function editPwd(Request $request)
    {
        return view('Home/User.editpwd');
    }

    // 显示修改密码
    public function showPwd(Request $request)
    {
        return view('Home/User.showepwd');
    }

    // 验证原密码
    public function yuanPwd(Request $request)
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
    public function savePwd(Request $request)
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
    public function showAddress(Request $request)
    {
        $id = session('UserInfo.id'); // 用户id

        // 地址信息
        $addrinfo = Addrs::where('uid', $id)->orderBy('acquiescent')->get()->toArray();


        return view('Home/User.user_address', ['addrinfo' => $addrinfo]);
    }

    // 添加地址
    public function addAddress(Request $request)
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
    public function delAddress(Request $request)
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
    public function defaultAddr(Request $request)
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
    public function editAddr(Request $request)
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
    public function ceditAddr(Request $request)
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
    public function showCollect(Request $request)
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
        
        return view('Home/User.user_collection', ['collects' => $goods]);
    }

    // 取消收藏
    public function cancelCollection(Request $request)
    {
        $id = $request->input('id'); // 商品id

        $uid = session('UserInfo.id'); // 用户ID

        $res = Collects::where('id', $id)
                ->delete();

        $res = Collects::where('goods_id', $id)
                        ->where('uid', $uid)
                        ->delete();
        if($res) {
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
    }

    // 显示订单
    public function user_Order(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID

        $orders = Orders::where('uid', $uid)->where('status', '<>', '4')->get();

        return view('Home/User.user_order', ['orders' => $orders]);
    }

    // 删除订单
    public function delOrder(Request $request)
    {
        $id = $request->input('id'); // 订单ID 

        $res = Orders::where('id', $id)->update(['status' => '4']);

        if($res) {
            return [
                'code' => 1,
                'msg' => '删除成功',
            ];
        } else {
            return response()->json([
                'code' => 0,
                'msg' => '网络错误，请重试',
            ], 500);
        }
    }

    // 取消订单
    public function cancelOrder(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID

        $oid = $request->input('oid'); // 订单ID

        $res = Orders::where('id', $oid)->where('uid', $uid)->where('status', '0')->first();

        if(!is_null($res)) {
            Orders::where('id', $oid)->where('uid', $uid)->where('status', '0')->delete(); // 删除订单

            Orders_details::where('oid', $oid)->delete(); // 删除订单详情

            return [
                'code' => 1,
                'msg' => '取消成功',
            ];
        } else {
             return response()->json([
                'code' => 0,
                'msg' => '网络错误，请重试',
            ], 500);
        }
    }

    // 订单详情
    public function orderDetail(Request $request)
    {
        $oid = $request->input('id');

        $uid = session('UserInfo.id'); // 用户ID

        $res = Orders::where('id', $oid)->where('uid', $uid)->where('status', '<>', '4')->first();

        if(is_null($res)) {
            return redirect('/home/userorder');
        } else {
            return view('Home/User.orderdetail', ['order' => $res]);
        }
    }

    // 添加评论
    public function addComments(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID

        $id = $request->input('id'); // 订单id

        $order = Orders::where('uid', $uid)->where('id', $id)->first();

        if(is_null($order)) {
            return redirect('/home/userorder');
        }

        $s = Orders_details::where('oid', $id)->select('gid')->get();

        $gids = [];

        foreach($s as $k => $v) {
            $gids[$k] = $v->gid;
        }

        $com = Comments::whereIn('gid', $gids)->where('uid', $uid)->where('oid', $id)->get();

        if(!$com->isEmpty()) { // 已经评价
            echo '<script>alert("该订单已经评价");location.href = "/home/userorder";</script>';
        }

        return view('Home/User.commentlist', ['order' => $order]);
    }

    // 处理添加评论
    public function caddComments(Request $request)
    {
        $uid = $request->input('id'); // 用户ID

        $data = $request->input('comments'); // 用户评价

        $oid = $request->input('id'); // 订单id

        foreach($data as $v) {
            $cos = explode("-",$v);

            $data = [
                'oid' => $oid,
                'uid' => $uid,
                'gid' => $cos[0],
                'pid' => 0,
                'type' => '0',
                'text' => $cos[1],
            ];
            $res = Comments::insertGetId($data);
            if(!$res) {
                return response()->json([
                    'code' => 0,
                    'msg' => '服务器异常，请重试',
                ], 500);
            }
        }
        return [
            'code' => 1,
            'msg' => '评论成功',
        ];
    }

    // 显示评论
    public function showComment(Request $request)
    {
        $uid = session('UserInfo.id'); // 用户ID

        $comm_info = Comments::where('uid', 1)->where('type', '0')->get();

        return view('Home/User.showcomment', ['comminfo' => $comm_info]);
    }

    // 显示物流
    public function showLogistics(Request $request)
    {
        $oid = $request->input('id'); // 订单ID

        $uid = session('UserInfo.id'); // 用户ID

        $res = Orders::where('id', $oid)->where('uid', $uid)->where('status', '2')->get();

        if($res->isEmpty()) {
            return redirect('/home/userorder');
        }

        $dizhi = Expresses::where('oid', $oid)->first();

        $dan = $dizhi->express; // 快递单号

        $express_all = json_decode($this->wuliu($dan));

        // 投递状态 0快递收件(揽件)1.在途中 2.正在派件 3.已签收 4.派送失败 5.疑难件 6.退件签收
        // deliverystatus
        $express_info = [];

        if($express_all->status == 0) {
            switch ($express_all->result->deliverystatus) {
                case '0':
                    $express_info['deliverystatus'] = '已揽件';
                    break;
                case '1':
                    $express_info['deliverystatus'] = '在途中';
                    break;
                case '2':
                    $express_info['deliverystatus'] = '正在派件';
                    break;
                case '3':
                    $express_info['deliverystatus'] = '已签收';
                    break;
                case '4':
                    $express_info['deliverystatus'] = '派送失败';
                    break;
                case '5':
                    $express_info['deliverystatus'] = '疑难件';
                    break;
                case '6':
                    $express_info['deliverystatus'] = '退件签收';
                    break;
            }
            $express_info['number'] = $express_all->result->number; // 快递单号
            $express_info['expName'] = $express_all->result->expName; // 快递公司
            $express_info['expPhone'] = $express_all->result->expPhone; // 快递公司电话
            $express_info['list'] = $express_all->result->list; // 物流信息
        }
        return view('Home/User.showLogistics', ['express_info' => $express_info]);
    }

    public function wuliu($dan)
    {
        $host = "https://wuliu.market.alicloudapi.com";//api访问链接
        $path = "/kdi";//API访问后缀
        $method = "GET";
        $appcode = "3ac67372ec9143de947565a14be1762f";//替换成自己的阿里云appcode
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "no=".$dan."&type=";  //参数写在这里
        $bodys = "";
        $url = $host . $path . "?" . $querys;//url拼接

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        //curl_setopt($curl, CURLOPT_HEADER, true); 如不输出json, 请打开这行代码，打印调试头部状态码。
        //状态码: 200 正常；400 URL无效；401 appCode错误； 403 次数用完； 500 API网管错误
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
        }
}

// goods_id = 商品id and img_type = 1 first