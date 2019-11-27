<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Comments;
use App\Model\Admin\Users;
use App\Model\Admin\Goods;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
  public function index(Request $request)
  { 
     
    $username = $request->input('username'); 

     $res = new Comments();

     $comments = $res->list($username);
 
  	return view('Admin/comment.comments',['comments'=>$comments]);
  }

   
  public function reply(Request $request) 
  {  
    $id = $request->input();
    
    $res = new Comments();
    $com = $res->reply($id);

    return view('Admin/comment.reply',['comment'=>$com,'id'=>$id]);
  }
   
  public function addreply(Request $request) 
  {
    $data = $request->input();  
    $res = new Comments();
    $addreply = $res->addreply($data);
        if ($addreply) {
          return response()->json([
            'code' => 0,
            'msg' => '评论成功！！！'
        ],200);
       } else {
         return response()->json([
            'code' => 1,
            'msg' => '网络繁忙，评论失败'

         ],500);
       }
    
  }
}