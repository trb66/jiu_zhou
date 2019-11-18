@extends('Admin.index')

@section('css')
@endsection


@section('body')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title am-fl">修改友链</div>
            <div class="widget-function am-fr">
                <a href="javascript:;" class="am-icon-cog"></a>
            </div>
        </div>
        <div class="widget-body am-fr">
            <div class="am-btn am-btn-default am-btn-danger" id="errors" style="display:none" role="alert">

            </div>
            <form class="am-form tpl-form-line-form">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">友链名 <span class="tpl-form-line-small-title">Title</span></label>
                    <div class="am-u-sm-9">
                        <input value="{{ $arr['name'] }}" id="name" type="text" class="tpl-form-input" id="user-name" placeholder="请输入友链名">
                        <small>请填写友链文字3-10字左右。</small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-3 am-form-label">友链地址 <span class="tpl-form-line-small-title">Time</span></label>
                    <div class="am-u-sm-9">
                        <input value="{{ $arr['url'] }}" id="url" type="text" class="am-form-field tpl-form-no-bg" placeholder="友链地址">
                        <small>友链地址</small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="user-weibo" class="am-u-sm-3 am-form-label">友链状态 <span class="tpl-form-line-small-title">status</span></label>
                    <div style="margin-right:550px" class="am-form-group tpl-table-list-select">
                        <select id="status" data-am-selected="{btnSize: 'sm'}">
                            <option value="1">显示</option>
                            <option value="2">禁用</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="am-form-group">
                <div class="am-u-sm-9 am-u-sm-push-3">
                    <button id="btn" type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    $('#btn').click(function(){
        var n = $('#name').val()
        var u = $('#url').val()
        var s = $('#status').val()


        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });

        $.ajax({
            type : 'post',
            url : "/admin/friendedit/{{ $arr['id'] }}",
            data:{name:n,url:u,status:s},
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
</script>
@endsection