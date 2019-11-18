@extends('Admin.index')

@section('css')
<!-- 引入分页样式 -->
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection


@section('body')
<div class="row-content am-cf">
<div class="row">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title  am-cf">轮播列表</div>
        </div>
        <div class="widget-body  am-fr">
            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                <div class="am-form-group">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="/admin/doadd" type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span>新增</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 搜索 -->
                <form action="/admin/lunbo" method="post" class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    {{ csrf_field() }}
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input value="" name="name" type="text" class="am-form-field ">
                        <span class="am-input-group-btn">
                        <button id="btn" class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                        </span>
                    </div>
                </form>
            <div class="am-u-sm-12">
                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                    <thead>
                        <tr>
                            <th>图片</th>
                            <th>图片名</th>
                            <th>状态</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $v)
                        <tr class="gradeX">
                            <td>
                                <img src="/storage/{{ $v['pic'] }}" class="tpl-table-line-img" alt="">
                            </td>
                            <td class="am-text-middle">{{ $v['name'] }}</td>
                            <td class="am-text-middle" style="cursor:pointer" onclick="status(this)" data-id="{{ $v['id'] }}" data-status="{{ $v['status'] }}">{{ $arr[ $v['status'] ] }}</td>
                            <td class="am-text-middle">{{ $v['create_at'] }}</td>
                            <td class="am-text-middle">
                                <div class="tpl-table-black-operation">
                                    <a href="/admin/edit/{{ $v['id'] }}">
                                        <i class="am-icon-pencil"></i> 编辑
                                    </a>
                                    <a onclick="del(this)" data-id="{{ $v['id'] }}" href="javascript:;" class="tpl-table-black-operation-del">
                                        <i class="am-icon-trash"></i> 删除
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- 分页 -->
        {{ $list->links() }}
    </div>
</div>
</div>
</div>
@endsection

@section('js')
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
//删除数据
function del(d){
    var lid = $(d).data('id');

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });

    $.ajax({
        type : 'post',
        url : '/admin/lunbo/del',
        data: {id:lid},
        success:function(res){
            if(res.code == 0){
                alert(res.msg)
                location.href = res.url
            }
        },
        error:function(err){
            if(res.code == 1){
                alert(res.msg)
            }
        }
    });
}
// 修改状态
function status(e){
    var sta = $(e).data('status');
    var d = $(e).data('id');
    var s = $(e).html()

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });

    $.ajax({
        type:'post',
        url : '/admin/statuse',
        data:{status:sta,id:d},
        success:function(res){
            if(res.code == 0){
                alert(res.msg);
                if(s == '禁用'){
                    $(e).html('显示')
                }else if(s == '显示'){
                    $(e).html('禁用')
                }
            }
        },
        error:function(err){
            if(res.code == 1){
                alert(res.msg);
                if(s == '禁用'){
                    $(e).html('显示')
                }else if(s == '显示'){
                    $(e).html('禁用')
                }
            }
        }
    });
}
</script>
@endsection