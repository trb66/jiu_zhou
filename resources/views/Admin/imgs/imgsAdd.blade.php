@extends('Admin.index')
@section('title', '添加图片')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('body')
<div class="row-content am-cf" style="background:#fff;margin-left:15px;margin-top:20px">
    <div class="am-header-left am-header-nav">
        <a href="/admin/imgs?id={{$good->id}}" class="am-btn am-btn-default">
        <span class="am-header-nav-title">返回</span>
        <i class="am-header-icon am-icon-home"></i>
        </a>
    </div>
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget-title  am-cf">添加图片</div>
            <div class="am-alert am-alert-danger" data-am-alert id="errors" style="display:none;">

            </div>      
            <form class="am-form">
                <legend>商品名字：{{$good->name}}</legend>
                <input type="hidden" name="goods_id" value="{{$good->id}}">
                <div class="am-form-group">
                    <label for="doc-select-1">选择图片的分类</label>
                    <select id="doc-select-1">
                        <option value="0">商品预览图</option>
                        <option value="1">商品介绍图</option>
                    </select>
                    <span class="am-form-caret"></span>
                </div>

                <fieldset>
                    <div class="am-form-group fileList" >
                        <label for="doc-ipt-file-1">图片上传</label>
                        <input type="file" id="doc-ipt-file-1" class="file" name="pic[]">
                        <p class="am-form-help">请选择要上传的图片...</p>
                    </div>
                </fieldset>
            </form>
<button type="button" id="btn" class="am-btn am-btn-success am-round">提交</button>
<button type="button" id="add" style="margin-left:20px" class="am-btn am-btn-primary am-round">添加一张图片</button>


        </div>
    </div>
</div>
@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
  $('#btn').click(function(){

        var  goods_id = $('input[name=goods_id]').val();
        var  img_type = $('#doc-select-1 option:checked').val();
        var files = $('.file');
        // console.dir(files);
        var data = new FormData();
         
        data.append('goods_id', goods_id);
        data.append('img_type', img_type);
        files.each(function(k){
            // console.dir(k)
            // console.dir(this.files[0])
            data.append('pic['+ k +']', this.files[0])

        })
        console.dir(data);
        $.ajax({
            type:'post',
            url:'/admin/imgs/addSub',
            data:data,
            processData: false, //关闭数据格式化
            contentType: false,  //不要设置数据类型
            headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            success: function(res) {
                console.dir(res);
                if (res.code == 0) {
                    alert(res.msg);
                    location.href = "/admin/imgs?id="+goods_id;
                }
            },
            error: function(err) {
                // console.log(err);
                let errs = err.responseJSON
                if(errs.code == 2){
                $('#errors').css('display', 'block').html(errs.msg)
                    
                } else {
                $('#errors').css('display', 'block').html(errs.msg)   
                }
            }
        })
        return false;    
  })


  $('#add').click(function(){
         $('.file:first').clone().val('').appendTo('.fileList');

    })
 
</script>

@endsection