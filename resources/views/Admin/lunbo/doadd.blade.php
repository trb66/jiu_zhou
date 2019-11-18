@extends('Admin.index')

@section('css')
@endsection


@section('body')
<div class="am-btn am-btn-default am-btn-danger" id="errors" style="display:none" role="alert">

</div>
<form enctype="multipart/form-data" class="am-form tpl-form-line-form" id="formData">
    {{ csrf_field() }}
    <div class="am-form-group">
        <label class="am-u-sm-3 am-form-label">轮播图片名</label>
        <div class="am-u-sm-9">
            <input name="name" type="text" placeholder="输入SEO关键字">
        </div>
    </div>
    <div style="margin-right:600px" class="am-form-group tpl-table-list-select">
        <select name="status" data-am-selected="{btnSize: 'sm'}">
            <option value="1">显示</option>
            <option value="2">禁用</option>
        </select>
    </div>
    <div class="am-form-group">
        <label for="user-weibo" class="am-u-sm-3 am-form-label">轮播图</label>
        <div class="am-u-sm-9 image">
            <input name="pic[]" class="pic" type="file" multiple>
        </div>
    </div>
</form>
<div class="am-form-group">
    <div class="am-u-sm-9 am-u-sm-push-3">
        <button id="btn" type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
        <button id="doadd" class="am-btn am-btn-primary tpl-btn-bg-color-success ">继续添加</button>
    </div>
</div>
@endsection


@section('js')
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    $('#btn').click(function(){
        let formData = new FormData($("#formData")[0]);

        $.ajax({
            type : 'post',
            url : '/admin/add',
            processData:false,
            contentType:false,
            data:formData,
            success:function(res){
                if(res.code == 0) {
                    alert(res.msg);
                    location.href = res.url;
                }
            },
            error:function(err){
                $('#errors').css('display','block').html('');

                let errs = err.responseJSON.errors

                for (e in errs) {
                    $('<p>'+ errs[e][0] +'</p>').appendTo('#errors');
                }
            }
        });
        return false;
    });
    $('#doadd').click(function(){
        $('.pic:first').clone().val('').appendTo('.image');
    });
</script>
@endsection