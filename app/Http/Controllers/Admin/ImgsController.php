<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Imgs;
use Illuminate\Support\Facades\DB;



class ImgsController extends Controller
{
    //显示每个商品的图片
    public function index(Request $request)
    {
        // $id = $request->all();
        $good = DB::table('goods')->where('id', $request->input('id'))->first();
        $img = new Imgs;
        // dd($good);//$res就是模型的返回值
        $res = $img->imgs($good->id);
        return view('Admin/imgs.imgs', ['good' => $good, 'imgs' => $res]);
    }
    
    //显示添加商品图片页面
    public function add(Request $request)
    {
         $id = $request->input('goods_id');
         $good = DB::table('goods')->where('id', $id)->first();
        return view('Admin/imgs.imgsAdd', ['good' => $good]);
    }

    //上传商品图片
    public function addSub(Request $request)
    {
        $this->validate($request, [
              'goods_id'=> 'required',
              'img_type' => 'required',
              // 'pic' => 'mimes:JPG',

        ], [
               'required' => ':attribute不能为空',
               'dimensions' => '不能上传非图片文件'
        ], [
               'goods_id' => '商品名',
               'img_type' => '商品状态',
               'pic' => '图片'
        ]);
        $data = [];
         //getMimeType() 拿出文件类型类型
        // dd($request->pic[0]->getMimeType());
        //多文件上传
        $imgRule = ['image/jpeg', 'image/gif', 'image/bmp', 'image/tga', 'image/exif', 'image/JPEG', 'image/tif'];
        foreach($request->pic as $file) {
            // dump($file->getMimeType());
            // 判断上传文件是否属于图片类型
            if(in_array($file->getMimeType(),$imgRule)){
                $data[] = [
                     'goods_id' => $request->goods_id,
                     'img_type' => $request->img_type,
                     'pic' => $file->store('commodity', 'public'),
                ];
                
            } else {
                return response()->json([
                 'code' => 2,
                 'msg' => '不能上传非图片类型文件'
            ],500);
            }

        }
        $imgs = new Imgs;
        $res = $imgs->addSub($data);

        if($res) {
            return [
               'code' => 0,
               'msg' => '添加成功'
            ];
        } else {
            return response()->json([
                 'code' => 1,
                 'msg' => '文件上传失败'
            ],500);
        }
    
    }

    //删除图片
    public function del(Request $request)
    {
        $id = $request->all();
        //条件语句
        $res = DB::table('imgs')->where('id',$id);
        //查询语句
        $img = $res->first();
        //删除数据库一条数据
        $delOk = $res->delete();
        //图片储存路径
        $urll = ('/www/wwwroot/jiu_zhou/storage/app/public/'.$img->pic);
        if($delOk){
         unlink($urll);
          return [
          'code' => 0,
          'msg' => '删除成功'
        ];
        } else {
          return response()->json([
          'code' => 1,
          'msg' => '删除失败' 

          ],500);
        }
            
    }
}
