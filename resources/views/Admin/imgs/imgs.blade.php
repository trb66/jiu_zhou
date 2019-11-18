@extends('Admin.index')
@section('title', '图片列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="/plug/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/plug/viewer/css/viewer.min.css">
@endsection
@section('body')

<div class="row-content am-cf" style="background:#fff;margin-left:15px;margin-top:20px">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget-title  am-cf">图片列表</div>

                <header data-am-widget="header" class="am-header am-header-default">
                    <div class="am-header-left am-header-nav">
                        <a href="/admin/goods" class="am-btn am-btn-default">
                        <span class="am-header-nav-title">返回</span>
                        <i class="am-header-icon am-icon-home"></i>
                        </a>
                    </div>
                    <h1 class="am-header-title" style="line-height:50px">{{$good->name}}</h1>
                    <div class="am-header-right am-header-nav">
                        <a href="#user-link" class="">
                            <i class="am-header-icon am-icon-user"></i>
                        </a>
                        <a href="#cart-link" class="am-btn am-btn-secondary">
                            <i class="am-header-icon am-icon-shopping-cart"></i>
                         </a>
                    </div>
                </header>
            <button type="button" style="margin-top:30px" class="am-btn am-btn-warning am-round" onclick = "add()">添加图片</button>
            <div style="margin-top:20px"></div>
            <div class="col-sm-6 col-md-6" style="border-right:2px solid gray" >
                <div class="alert alert-success" role="alert">
                    <a  class="alert-link">商品缩略图</a>
                </div>
              @foreach($imgs as $img)

                    @if($img['img_type'] == 0) 
                   
                    <div class="col-sm-6 col-md-12" >
                        <div class="thumbnail">
                         
                            <img style="width:300px; height:200px" src="/storage/{{$img['pic']}}" class="imgss" data-original="/storage/{{$img['pic']}}" alt="..." class="img-thumbnail">
                            <div class="caption">
                                <h3></h3>
                                <p>{{$img['img_type']}}</p>
                                <p><a   class="btn btn-default" onclick="return del(this)" data-id="{{$img['id']}}" role="button">刪除</a></p>
                            </div>
                        </div>
                    </div>
                    @endif
           
              @endforeach
                
            </div>
           
            <div class="col-sm-6 col-md-6" >
                <div class="alert alert-success" role="alert">
                    <a  class="alert-link">商品介绍图</a>
                </div>
              @foreach($imgs as $img)
                @if($img['img_type'] == 1) 
                    
                    <div class="col-sm-6 col-md-12" >
                        <div class="thumbnail">
                         
                            <img style="width:300px; height:200px" src="/storage/{{$img['pic']}}" class="imgss" data-original="/storage/{{$img['pic']}}" alt="..." class="img-thumbnail">
                            <div class="caption">
                                <h3></h3>
                                <p>{{$img['img_type']}}</p>
                                <input type="hidden" value="{{$img['id']}}">
                                <p><a  class="btn btn-default" onclick="return del(this)" data-id="{{$img['id']}}" role="button">刪除</a></p>
                            </div>
                        </div>
                    </div>
                    @endif
            @endforeach
            </div>

     
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="/plug/bootstrap/js/bootstrap.min.js"></script>
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script src="/plug/viewer/js/viewer-jquery.min.js"></script>




<script>
     function add()
     {
        window.location.replace("/admin/imgs/add?goods_id={{$good->id}}");
     }


     //ajax删除
    function del(zj){
        var id=$(zj).data('id');
        var imgDiv = $(zj).parent().parent().parent().parent();
        console.dir(imgDiv)
        $.ajax({
            type:'post',
            url: '/admin/imgs/del',
            headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            dataType:'json',
            data:{id:id},
            success:function(res) {
                if(res) {
                    imgDiv.remove();
                }
            },
            error:function(err) {
                if(err.code == 1) {
                    alert('删除失败')
                }
            }

        })
        return false;

    }

//网页加载完成了就执行
$(function() {
    $('.imgss').viewer({
        url: 'data-original',
       });
     });

   

</script>
@endsection