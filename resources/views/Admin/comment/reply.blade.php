@extends('Admin.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<style>
    
    #xingxi{
        background:  #d2d6de;
        padding:7px;
        color: black;
        border-radius:4px;
        float: left;
        margin:0 10px;    
        max-width:80%;
        border: 1px solid #ededed;
        position: relative;
    }
    #xxbox{
        height: 80px; 
        margin-top: 20px;
        margin-bottom: 20px;
    }

    #xxname{
        color: black;
        margin-left: 5px;
        margin-right: 5px;
    }
    #xxdate{
        color: blue;
        margin-left: 5px;
        margin-right: 5px;
    }

    #rxingxi{
        background: #36BC9B;
        color: white;
        padding:7px;
        border-radius:4px;
        float: right;
        margin:0 10px;
        max-width:80%;
        border: 1px solid #ededed;
        position: relative;

    }


    #rxxname{
        color: black;
        float: right;
        margin-left: 5px;
        margin-right: 5px;
    }
    #rxxdate{
        color: blue;
        float: right;
        margin-left: 5px;
        margin-right: 5px;
    }

</style>
@endsection

@section('title','评论回复')

@section('body')
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
           <div class="widget am-cf">
             <div class="widget-head am-cf">
                  <div class="widget-title  am-cf">评论回复</div>
            </div>
           <div class="widget-body am-fr" style="height: 100%">
              
            <div class="am-u-sm-12" style="background-color: #F5F5F5;border: 1px solid #ccc; border-radius:5px; ">
                
                @foreach($comment as $v)
                
                @if($v['type'] == 0)
                <div id="xxbox">
                   <img src="" alt=""><span id="xxname">{{$v->username->username}}</span><span id="xxdate">{{$v['created_at']}}</span><br>
                   <span id="xingxi">{{$v['text']}}</span>
                </div>
                 @endif
                 @if($v['type'] ==1) 
                <div id="xxbox" >
                   <img src="" alt=""><span id="rxxname" >九州客服</span><span id="rxxdate" >{{$v['created_at']}}</span><br>
                   <span id="rxingxi">{{$v['text']}}</span>
                </div>          
                 @endif
              @endforeach
            </div>
             <form>
                <input type="hidden" value="{{$id['uid']}}" name="uid" id="uid">
                <input type="hidden" value="{{$id['gid']}}" name="gid" id="gid">

                <textarea class="form-control" rows="3" placeholder="请输入回复内容" name="content" id="reply-text"></textarea>
                <button type="button" class="btn btn-primary pull-right " onclick="return reply(this)" data-id="{{$id['id']}}" style="margin-top: 10px;">回复</button>
            </form>
           </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/Admin/assets/js/jquery.min.js"></script>
<script>
   function reply(text) 
   {
     var id = $(text).data('id');
     var text = $('#reply-text').val();
     var uid = $('#uid').val();
     var gid = $('#gid').val();
    

          $.ajaxSetup({ 
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
            $.ajax({
                type: 'post',
                url: '/admin/comments/addreply',
                data: {
                   id:id,
                   uid:uid,
                   gid:gid,
                   text:text,
                },
                success: function(res) {  
                  location.reload();
                              
                },
                error: function (err) {
                   alert(err.responseJSON.msg);
                }
            })
      }
</script>
@endsection



